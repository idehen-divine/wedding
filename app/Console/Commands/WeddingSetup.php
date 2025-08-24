<?php

namespace App\Console\Commands;

use App\Models\StoryTimeline;
use App\Models\User;
use App\Models\WeddingSetting;
use App\Models\WeddingWish;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class WeddingSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wedding:setup {--reset : Reset existing data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up wedding website with default data and configurations';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🎉 Setting up Wedding Website...');
        $this->newLine();

        $reset = $this->option('reset');

        // Step 1: Clean storage files if reset
        if ($reset) {
            $this->info('🧹 Cleaning up storage files...');
            $this->cleanupStorageFiles();
            $this->newLine();
        }

        // Step 2: Run migrations
        if ($reset) {
            $this->info('📋 Running fresh database migrations...');
            $this->call('migrate:fresh', ['--force' => true]);
        } else {
            $this->info('📋 Running database migrations...');
            $this->call('migrate');
        }
        $this->newLine();

        // Step 3: Create storage link
        $this->info('🔗 Creating storage symbolic link...');
        if (! File::exists(public_path('storage'))) {
            $this->call('storage:link');
        } else {
            $this->info('Storage link already exists');
        }
        $this->newLine();

        // Step 4: Set up storage directories
        $this->info('📁 Setting up storage directories...');
        $this->setupStorageDirectories();
        $this->newLine();

        // Step 5: Copy story images
        $this->info('🖼️  Copying story images to storage...');
        $this->copyStoryImages();
        $this->newLine();

        // Step 7: Copy audio files
        $this->info('🎵 Copying audio files to storage...');
        $this->copyAudioFiles();
        $this->newLine();

        // Step 8: Seed database
        if ($reset || $this->confirm('Seed the database with default data?', false)) {
            $this->info('🌱 Seeding database with default data...');

            // Truncate tables before seeding
            $this->info('Truncating existing data...');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            StoryTimeline::truncate();
            WeddingWish::truncate();
            WeddingSetting::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->call('db:seed');
            $this->newLine();
        }

        // Step 9: Create admin user
        $this->info('👤 Setting up admin user...');
        $this->createAdminUser($reset);
        $this->newLine();

        // Step 10: Verify setup
        $this->info('✅ Verifying setup...');
        $this->verifySetup();

        $this->info('🎊 Wedding website setup completed successfully!');
        $this->newLine();

        $this->info('Next steps:');
        $this->line('• Visit /admin to manage content (admin@wedding.com / password)');
        $this->line('• Visit /story to see the timeline');
        $this->line('• Run "npm run dev" for frontend development');
        $this->line('• Change admin password in /admin/profile');

        return SymfonyCommand::SUCCESS;
    }

    private function cleanupStorageFiles(): void
    {
        $directories = [
            'story-images',
            'gallery-images',
            'uploads',
            'audio',
            'temp-audio',
        ];

        foreach ($directories as $dir) {
            $storageDir = storage_path("app/public/{$dir}");
            if (File::exists($storageDir)) {
                // Get all files in directory
                $files = File::allFiles($storageDir);
                $fileCount = count($files);

                if ($fileCount > 0) {
                    // Delete all files in the directory
                    File::cleanDirectory($storageDir);
                    $this->info("Cleaned: {$dir}/ ({$fileCount} files removed)");
                } else {
                    $this->line("Already clean: {$dir}/");
                }
            }
        }
    }

    private function setupStorageDirectories(): void
    {
        $directories = [
            'story-images',
            'gallery-images',
            'uploads',
            'audio',
            'temp-audio',
        ];

        foreach ($directories as $dir) {
            $storageDir = storage_path("app/public/{$dir}");
            if (! File::exists($storageDir)) {
                File::makeDirectory($storageDir, 0755, true);
                $this->info("Created: {$dir}/");
            } else {
                $this->line("Exists: {$dir}/");
            }
        }
    }

    private function copyStoryImages(): void
    {
        $assetsDir = public_path('assets/images');
        $storageDir = storage_path('app/public/story-images');
        $imageFiles = ['story-1.jpg', 'story-2.jpg', 'story-3.jpg', 'story-4.jpg'];

        foreach ($imageFiles as $file) {
            $sourcePath = $assetsDir.'/'.$file;
            $destinationPath = $storageDir.'/'.$file;

            if (File::exists($sourcePath) && ! File::exists($destinationPath)) {
                File::copy($sourcePath, $destinationPath);
                $this->info("Copied: {$file}");
            } elseif (File::exists($destinationPath)) {
                $this->line("Exists: {$file}");
            } else {
                $this->warn("Source not found: {$file}");
            }
        }
    }

    private function copyAudioFiles(): void
    {
        $assetsDir = public_path('assets/audio');
        $storageDir = storage_path('app/public/audio');

        // Get all audio files from assets directory
        if (File::exists($assetsDir)) {
            $audioFiles = File::files($assetsDir);

            foreach ($audioFiles as $file) {
                if (in_array($file->getExtension(), ['mp3', 'wav', 'ogg'])) {
                    $fileName = $file->getFilename();
                    $sourcePath = $file->getPathname();
                    $destinationPath = $storageDir.'/'.$fileName;

                    if (! File::exists($destinationPath)) {
                        File::copy($sourcePath, $destinationPath);
                        $this->info("Copied: {$fileName}");
                    } else {
                        $this->line("Exists: {$fileName}");
                    }
                }
            }
        } else {
            $this->warn('Assets audio directory not found');
        }
    }

    private function createAdminUser(bool $reset): void
    {
        // Check if admin user already exists
        $adminExists = User::where('email', 'admin@wedding.com')->exists();

        if (! $reset && $adminExists) {
            $this->info('Admin user already exists: admin@wedding.com');

            return;
        }

        if ($reset && $adminExists) {
            User::where('email', 'admin@wedding.com')->delete();
            $this->info('Removed existing admin user');
        }

        // Create admin user
        $user = User::create([
            'name' => 'Wedding Admin',
            'email' => 'admin@wedding.com',
            'password' => bcrypt('Password'),
            'email_verified_at' => now(),
        ]);

        $this->info('✓ Admin user created:');
        $this->line('  Email: admin@wedding.com');
        $this->line('  Password: Password');
        $this->warn('  ⚠️  Change the password after first login!');
    }

    private function verifySetup(): void
    {
        // Check database
        $storyCount = StoryTimeline::count();
        $this->line("• Story timeline events: {$storyCount}");

        $wishCount = WeddingWish::count();
        $approvedWishCount = WeddingWish::where('approved', true)->count();
        $this->line("• Wedding wishes: {$wishCount} ({$approvedWishCount} approved)");

        $userCount = User::count();
        $adminExists = User::where('email', 'admin@wedding.com')->exists();
        $this->line("• Users: {$userCount} ".($adminExists ? '(admin ✓)' : '(no admin)'));

        $settingCount = WeddingSetting::count();
        $this->line("• Wedding settings: {$settingCount}");

        // Check storage directories
        $storageExists = File::exists(storage_path('app/public/story-images'));
        $this->line('• Story images directory: '.($storageExists ? '✓' : '✗'));

        // Check symlink
        $symlinkExists = File::exists(public_path('storage'));
        $this->line('• Storage symlink: '.($symlinkExists ? '✓' : '✗'));

        // Check sample images
        $imageCount = count(File::glob(storage_path('app/public/story-images/*.jpg')));
        $this->line("• Story images copied: {$imageCount}");

        // Check audio files
        $audioCount = count(File::glob(storage_path('app/public/audio/*.{mp3,wav,ogg}'), GLOB_BRACE));
        $this->line("• Audio files copied: {$audioCount}");
    }
}
