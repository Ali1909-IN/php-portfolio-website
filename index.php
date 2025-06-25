<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$settings = getSettings();
$projects = getProjects();
$skills = getSkills();
$services = getServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($settings['site_title'] ?? 'Portfolio'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: {
                            50: '#f8fafc',
                            900: '#0f172a',
                            950: '#020617'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50 dark:bg-slate-950">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl z-50 border-b border-slate-200 dark:border-slate-800">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold bg-gradient-to-r from-blue-600 via-violet-600 to-emerald-600 bg-clip-text text-transparent">
                    <?php echo htmlspecialchars($settings['site_title'] ?? 'Portfolio'); ?>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">Home</a>
                    <a href="#about" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">About</a>
                    <a href="#skills" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">Skills</a>
                    <a href="#services" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">Services</a>
                    <a href="#portfolio" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">Portfolio</a>
                    <a href="#contact" class="nav-link text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300 font-medium">Contact</a>
                </div>

                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                    <i class="fas fa-bars w-5 h-5"></i>
                </button>
            </div>

            <div id="mobile-menu" class="md:hidden mt-4 py-4 border-t border-slate-200 dark:border-slate-800 hidden">
                <a href="#home" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a>
                <a href="#about" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a>
                <a href="#skills" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Skills</a>
                <a href="#services" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Services</a>
                <a href="#portfolio" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Portfolio</a>
                <a href="#contact" class="block py-2 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-20 px-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-violet-50 to-emerald-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(59,130,246,0.1),transparent)] dark:bg-[radial-gradient(circle_at_30%_20%,rgba(59,130,246,0.05),transparent)]"></div>
        
        <div class="container mx-auto text-center relative z-10">
            <div class="max-w-5xl mx-auto">
                <div class="mb-12 group">
                    <div class="w-48 h-48 mx-auto mb-8 rounded-full bg-gradient-to-br from-blue-500 via-violet-500 to-emerald-500 p-1 group-hover:scale-105 transition-transform duration-300">
                        <div class="w-full h-full rounded-full bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden">
                            <?php if (!empty($settings['profile_image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($settings['profile_image_url']); ?>" alt="Profile" class="object-cover w-full h-full rounded-full">
                            <?php else: ?>
                                <span class="text-5xl font-bold bg-gradient-to-br from-blue-600 via-violet-600 to-emerald-600 bg-clip-text text-transparent">
                                    <?php echo strtoupper(substr($settings['site_title'] ?? 'P', 0, 2)); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <h1 class="text-6xl md:text-8xl font-bold text-slate-900 dark:text-white mb-8 leading-tight">
                    Hello, I'm
                    <span class="block bg-gradient-to-r from-blue-600 via-violet-600 to-emerald-600 bg-clip-text text-transparent">
                        <?php echo htmlspecialchars($settings['site_title'] ?? 'Your Name'); ?>
                    </span>
                </h1>
                
                <p class="text-2xl md:text-3xl text-slate-600 dark:text-slate-300 mb-8 font-light">
                    <?php echo htmlspecialchars($settings['tagline'] ?? 'Professional Developer'); ?>
                </p>
                
                <p class="text-lg text-slate-500 dark:text-slate-400 mb-12 max-w-4xl mx-auto leading-relaxed">
                    <?php echo htmlspecialchars($settings['about_text'] ?? 'Welcome to my portfolio website.'); ?>
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="#about" class="bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-700 hover:to-violet-700 text-white px-8 py-4 text-lg rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 inline-block">
                        Learn More About Me
                    </a>
                    <a href="#contact" class="border-2 border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 px-8 py-4 text-lg rounded-full transition-all duration-300 transform hover:-translate-y-1 inline-block">
                        Get In Touch
                    </a>
                </div>
            </div>
            
            <div class="mt-20 animate-bounce">
                <i class="fas fa-arrow-down w-6 h-6 mx-auto text-slate-400 dark:text-slate-500"></i>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-6 bg-white dark:bg-slate-900">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">About Me</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-violet-600 mx-auto"></div>
            </div>
            
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($settings['about_text'] ?? 'Professional with expertise in modern technologies and development practices.')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">Skills</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-violet-600 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($skills as $category => $categorySkills): ?>
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4"><?php echo htmlspecialchars($category); ?></h3>
                    <div class="space-y-3">
                        <?php foreach ($categorySkills as $skill): ?>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600 dark:text-slate-300"><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded">
                                <?php echo htmlspecialchars($skill['proficiency_level']); ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Services/Experience Section -->
    <section id="services" class="py-20 px-6 bg-white dark:bg-slate-900">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">Experience</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-violet-600 mx-auto"></div>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <?php foreach ($services as $service): ?>
                <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6 mb-6 border-l-4 border-blue-600">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white"><?php echo htmlspecialchars($service['designation']); ?></h3>
                            <p class="text-lg text-blue-600 dark:text-blue-400 font-medium"><?php echo htmlspecialchars($service['company_name']); ?></p>
                        </div>
                        <div class="text-slate-500 dark:text-slate-400 mt-2 md:mt-0">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar text-sm"></i>
                                <span><?php echo date('M Y', strtotime($service['start_date'])); ?> - 
                                    <?php echo $service['end_date'] ? date('M Y', strtotime($service['end_date'])) : 'Present'; ?>
                                </span>
                            </div>
                            <?php if ($service['location']): ?>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-sm"></i>
                                <span><?php echo htmlspecialchars($service['location']); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm rounded-full">
                            <?php echo htmlspecialchars($service['employment_type']); ?>
                        </span>
                    </div>
                    
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo htmlspecialchars($service['job_responsibility']); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">My Portfolio</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-violet-600 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($projects as $project): ?>
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <?php if (!empty($project['banner_image_url'])): ?>
                    <div class="aspect-video overflow-hidden">
                        <img src="<?php echo htmlspecialchars($project['banner_image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($project['header']); ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm rounded-full">
                                <?php echo htmlspecialchars($project['category']); ?>
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                            <?php echo htmlspecialchars($project['header']); ?>
                        </h3>
                        
                        <p class="text-slate-600 dark:text-slate-300 mb-4">
                            <?php echo htmlspecialchars($project['brief_info']); ?>
                        </p>
                        
                        <?php if (!empty($project['tools_skills'])): ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach (explode(',', $project['tools_skills']) as $skill): ?>
                            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs rounded">
                                <?php echo htmlspecialchars(trim($skill)); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <button onclick="openProjectModal(<?php echo htmlspecialchars(json_encode($project)); ?>)" 
                                class="text-blue-600 hover:text-blue-700 font-medium">
                            View Details →
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-white dark:bg-slate-900">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">Get In Touch</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-violet-600 mx-auto"></div>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Contact Information</h3>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">Email</p>
                                <a href="mailto:<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>" class="text-slate-900 dark:text-white font-medium hover:text-blue-600">
                                    <?php echo htmlspecialchars($settings['contact_email'] ?? 'contact@example.com'); ?>
                                </a>
                            </div>
                        </div>
                        
                        <?php 
                        $social = json_decode($settings['social_links'] ?? '{}', true);
                        if (!empty($social['linkedin']) || !empty($social['github'])):
                        ?>
                        <div>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">Follow me on</p>
                            <div class="flex gap-4">
                                <?php if (!empty($social['linkedin'])): ?>
                                <a href="<?php echo htmlspecialchars($social['linkedin']); ?>" target="_blank" class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                                    <i class="fab fa-linkedin text-blue-600 dark:text-blue-400 text-xl"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($social['github'])): ?>
                                <a href="<?php echo htmlspecialchars($social['github']); ?>" target="_blank" class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-lg flex items-center justify-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                                    <i class="fab fa-github text-slate-600 dark:text-slate-400 text-xl"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div>
                    <form id="contact-form" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 font-medium mb-2">Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-slate-700 dark:text-slate-300 font-medium mb-2">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-slate-700 dark:text-slate-300 font-medium mb-2">Subject</label>
                            <input type="text" name="subject" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-slate-700 dark:text-slate-300 font-medium mb-2">Message</label>
                            <textarea name="message" rows="6" required class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-700 hover:to-violet-700 text-white px-8 py-4 text-lg rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 bg-slate-900 dark:bg-slate-950 text-slate-400 text-center border-t border-slate-800">
        <div class="container mx-auto">
            <p class="text-lg">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($settings['site_title'] ?? 'Portfolio'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Project Modal -->
    <div id="project-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-900 rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <h3 id="modal-title" class="text-2xl font-bold text-slate-900 dark:text-white"></h3>
                    <button onclick="closeProjectModal()" class="text-slate-500 hover:text-slate-700 dark:hover:text-slate-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="modal-content"></div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>