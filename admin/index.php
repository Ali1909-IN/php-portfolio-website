<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Simple admin authentication
if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Simple hardcoded admin (CHANGE THESE CREDENTIALS)
        if ($username === 'admin' && $password === 'CHANGE_THIS_PASSWORD') {
            $_SESSION['admin_logged_in'] = true;
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid credentials';
        }
    }
    
    // Show login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="min-h-screen bg-slate-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Admin Login</h1>
            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" name="login" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_settings'])) {
        $settings = [
            'site_title' => trim($_POST['site_title']),
            'tagline' => trim($_POST['tagline']),
            'about_text' => trim($_POST['about_text']),
            'contact_email' => trim($_POST['contact_email']),
            'profile_image_url' => trim($_POST['profile_image_url']),
            'social_links' => [
                'linkedin' => trim($_POST['linkedin'] ?? ''),
                'github' => trim($_POST['github'] ?? '')
            ]
        ];
        
        if (updateSettings($settings)) {
            $success = 'Settings updated successfully';
            // Refresh settings data
            $settings = getSettings();
        } else {
            $error = 'Failed to update settings';
        }
    }
    
    if (isset($_POST['add_project'])) {
        $project = [
            'header' => $_POST['header'],
            'brief_info' => $_POST['brief_info'],
            'tools_skills' => $_POST['tools_skills'],
            'banner_image_url' => $_POST['banner_image_url'],
            'challenge' => $_POST['challenge'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'learning' => $_POST['learning'],
            'website_link' => $_POST['website_link'],
            'category' => $_POST['category']
        ];
        
        if (addProject($project)) {
            $success = 'Project added successfully';
        } else {
            $error = 'Failed to add project';
        }
    }
    
    if (isset($_POST['delete_project'])) {
        if (deleteProject($_POST['project_id'])) {
            $success = 'Project deleted successfully';
        } else {
            $error = 'Failed to delete project';
        }
    }
    
    if (isset($_POST['add_skill'])) {
        $skill = [
            'category' => $_POST['skill_category'],
            'skill_name' => $_POST['skill_name'],
            'proficiency_level' => $_POST['proficiency_level']
        ];
        
        if (addSkill($skill)) {
            $success = 'Skill added successfully';
        } else {
            $error = 'Failed to add skill';
        }
    }
    
    if (isset($_POST['delete_skill'])) {
        if (deleteSkill($_POST['skill_id'])) {
            $success = 'Skill deleted successfully';
        } else {
            $error = 'Failed to delete skill';
        }
    }
    
    if (isset($_POST['add_service'])) {
        $service = [
            'company_name' => $_POST['company_name'],
            'designation' => $_POST['designation'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'job_responsibility' => substr($_POST['job_responsibility'], 0, 200),
            'location' => $_POST['location'],
            'employment_type' => $_POST['employment_type']
        ];
        
        if (addService($service)) {
            $success = 'Experience added successfully';
        } else {
            $error = 'Failed to add experience';
        }
    }
    
    if (isset($_POST['delete_service'])) {
        if (deleteService($_POST['service_id'])) {
            $success = 'Experience deleted successfully';
        } else {
            $error = 'Failed to delete experience';
        }
    }
}

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
    <title>Portfolio Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-50">
    <div class="border-b border-slate-200 mb-6">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Portfolio Admin</h1>
            <div class="flex gap-4">
                <a href="../index.php" target="_blank" class="text-blue-600 hover:text-blue-800">View Site</a>
                <a href="?logout=1" class="text-red-600 hover:text-red-800">Logout</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6">
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Site Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Site Settings</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Site Title</label>
                        <input type="text" name="site_title" value="<?php echo htmlspecialchars($settings['site_title'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tagline</label>
                        <input type="text" name="tagline" value="<?php echo htmlspecialchars($settings['tagline'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">About Text</label>
                        <textarea name="about_text" rows="3" class="w-full px-3 py-2 border rounded-lg"><?php echo htmlspecialchars($settings['about_text'] ?? ''); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Contact Email</label>
                        <input type="email" name="contact_email" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Profile Image URL</label>
                        <input type="url" name="profile_image_url" value="<?php echo htmlspecialchars($settings['profile_image_url'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">LinkedIn URL</label>
                        <input type="url" name="linkedin" value="<?php echo htmlspecialchars(json_decode($settings['social_links'] ?? '{}', true)['linkedin'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">GitHub URL</label>
                        <input type="url" name="github" value="<?php echo htmlspecialchars(json_decode($settings['social_links'] ?? '{}', true)['github'] ?? ''); ?>" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <button type="submit" name="update_settings" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Update Settings
                    </button>
                </form>
            </div>

            <!-- Add Skill -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Add Skill</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <input type="text" name="skill_category" required class="w-full px-3 py-2 border rounded-lg" placeholder="e.g., Programming, Database">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Skill Name</label>
                        <input type="text" name="skill_name" required class="w-full px-3 py-2 border rounded-lg" placeholder="e.g., PHP, MySQL">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Proficiency Level</label>
                        <select name="proficiency_level" class="w-full px-3 py-2 border rounded-lg">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate" selected>Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                    <button type="submit" name="add_skill" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Add Skill
                    </button>
                </form>
            </div>

            <!-- Add Experience -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Add Experience</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Company Name</label>
                        <input type="text" name="company_name" required class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Designation</label>
                        <input type="text" name="designation" required class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Start Date</label>
                            <input type="date" name="start_date" required class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">End Date (Leave empty if current)</label>
                            <input type="date" name="end_date" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Location</label>
                        <input type="text" name="location" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Employment Type</label>
                        <select name="employment_type" class="w-full px-3 py-2 border rounded-lg">
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Freelance">Freelance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Job Responsibility (Max 200 chars)</label>
                        <textarea name="job_responsibility" maxlength="200" rows="3" class="w-full px-3 py-2 border rounded-lg" placeholder="Brief description of responsibilities..."></textarea>
                    </div>
                    <button type="submit" name="add_service" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Add Experience
                    </button>
                </form>
            </div>

        </div>

        <!-- Add Project -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Add New Project</h2>
            <form method="POST" class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Project Title</label>
                    <input type="text" name="header" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="category" class="w-full px-3 py-2 border rounded-lg">
                        <option value="Development">Development</option>
                        <option value="Administration">Administration</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Brief Description</label>
                    <textarea name="brief_info" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tools & Skills</label>
                    <input type="text" name="tools_skills" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Banner Image URL</label>
                    <input type="url" name="banner_image_url" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Start Date</label>
                    <input type="date" name="start_date" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">End Date</label>
                    <input type="date" name="end_date" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Challenge</label>
                    <textarea name="challenge" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Learning</label>
                    <textarea name="learning" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Website Link</label>
                    <input type="url" name="website_link" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="flex items-end">
                    <button type="submit" name="add_project" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Add Project
                    </button>
                </div>
            </form>
        </div>

        <!-- Skills List -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Skills</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($skills as $category => $categorySkills): ?>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-3"><?php echo htmlspecialchars($category); ?></h3>
                    <?php foreach ($categorySkills as $skill): ?>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm"><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded"><?php echo htmlspecialchars($skill['proficiency_level']); ?></span>
                            <form method="POST" class="inline">
                                <input type="hidden" name="skill_id" value="<?php echo $skill['id']; ?>">
                                <button type="submit" name="delete_skill" onclick="return confirm('Delete skill?')" class="bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                    ×
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Experience List -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Experience</h2>
            <div class="space-y-4">
                <?php foreach ($services as $service): ?>
                <div class="border rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold"><?php echo htmlspecialchars($service['designation']); ?></h3>
                            <p class="text-blue-600"><?php echo htmlspecialchars($service['company_name']); ?></p>
                            <p class="text-sm text-gray-600"><?php echo date('M Y', strtotime($service['start_date'])); ?> - <?php echo $service['end_date'] ? date('M Y', strtotime($service['end_date'])) : 'Present'; ?></p>
                            <p class="text-sm mt-2"><?php echo htmlspecialchars($service['job_responsibility']); ?></p>
                        </div>
                        <form method="POST" class="inline">
                            <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                            <button type="submit" name="delete_service" onclick="return confirm('Delete experience?')" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Projects List -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Projects</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($projects as $project): ?>
                <div class="border rounded-lg p-4">
                    <?php if ($project['banner_image_url']): ?>
                        <img src="<?php echo htmlspecialchars($project['banner_image_url']); ?>" alt="<?php echo htmlspecialchars($project['header']); ?>" class="w-full h-32 object-cover rounded mb-3">
                    <?php endif; ?>
                    <h3 class="font-semibold mb-2"><?php echo htmlspecialchars($project['header']); ?></h3>
                    <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($project['brief_info']); ?></p>
                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-3"><?php echo htmlspecialchars($project['category']); ?></span>
                    <form method="POST" class="inline">
                        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                        <button type="submit" name="delete_project" onclick="return confirm('Delete project?')" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            Delete
                        </button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>