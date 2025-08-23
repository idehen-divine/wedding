<?php

namespace App\Console\Commands;

use App\Models\StoryTimeline;
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

        // Step 1: Run migrations
        if ($reset) {
            $this->info('📋 Running fresh database migrations...');
            $this->call('migrate:fresh', ['--force' => true]);
        } else {
            $this->info('📋 Running database migrations...');
            $this->call('migrate');
        }
        $this->newLine();

        // Step 2: Create storage link
        $this->info('🔗 Creating storage symbolic link...');
        if (!File::exists(public_path('storage'))) {
            $this->call('storage:link');
        } else {
            $this->info('Storage link already exists');
        }
        $this->newLine();

        // Step 3: Set up storage directories
        $this->info('📁 Setting up storage directories...');
        $this->setupStorageDirectories();
        $this->newLine();

        // Step 4: Copy story images
        $this->info('🖼️  Copying story images to storage...');
        $this->copyStoryImages();
        $this->newLine();

        // Step 5: Seed database
        if ($reset || $this->confirm('Seed the database with default data?', true)) {
            $this->info('🌱 Seeding database with default data...');
            $this->call('db:seed');
            $this->newLine();
        }

        // Step 6: Verify setup
        $this->info('✅ Verifying setup...');
        $this->verifySetup();

        $this->info('🎊 Wedding website setup completed successfully!');
        $this->newLine();
        
        $this->info('Next steps:');
        $this->line('• Visit /admin to manage content');
        $this->line('• Visit /story to see the timeline');
        $this->line('• Run "npm run dev" for frontend development');
        
        return SymfonyCommand::SUCCESS;
    }

    private function setupStorageDirectories(): void
    {
        $directories = [
            'story-images',
            'gallery-images',
            'uploads'
        ];

        foreach ($directories as $dir) {
            $storageDir = storage_path("app/public/{$dir}");
            if (!File::exists($storageDir)) {
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
            $sourcePath = $assetsDir . '/' . $file;
            $destinationPath = $storageDir . '/' . $file;
            
            if (File::exists($sourcePath) && !File::exists($destinationPath)) {
                File::copy($sourcePath, $destinationPath);
                $this->info("Copied: {$file}");
            } elseif (File::exists($destinationPath)) {
                $this->line("Exists: {$file}");
            } else {
                $this->warn("Source not found: {$file}");
            }
        }
    }


    private function verifySetup(): void
    {
        // Check database
        $storyCount = StoryTimeline::count();
        $this->line("• Story timeline events: {$storyCount}");

        // Check storage directories
        $storageExists = File::exists(storage_path('app/public/story-images'));
        $this->line("• Story images directory: " . ($storageExists ? '✓' : '✗'));

        // Check symlink
        $symlinkExists = File::exists(public_path('storage'));
        $this->line("• Storage symlink: " . ($symlinkExists ? '✓' : '✗'));

        // Check sample images
        $imageCount = count(File::glob(storage_path('app/public/story-images/*.jpg')));
        $this->line("• Story images copied: {$imageCount}");
    }
}
