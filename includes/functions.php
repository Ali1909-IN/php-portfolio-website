<?php
function getSettings() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM site_settings ORDER BY created_at DESC LIMIT 1");
        $settings = $stmt->fetch();
        return $settings ?: [
            'site_title' => 'Your Portfolio',
            'tagline' => 'Professional Developer',
            'about_text' => 'Welcome to my portfolio website.',
            'contact_email' => 'contact@example.com',
            'profile_image_url' => '',
            'social_links' => json_encode(['linkedin' => '', 'github' => '', 'twitter' => ''])
        ];
    } catch(PDOException $e) {
        return [
            'site_title' => 'Your Portfolio',
            'tagline' => 'Professional Developer',
            'about_text' => 'Welcome to my portfolio website.',
            'contact_email' => 'contact@example.com',
            'profile_image_url' => '',
            'social_links' => json_encode(['linkedin' => '', 'github' => '', 'twitter' => ''])
        ];
    }
}

function getProjects($category = null) {
    global $pdo;
    try {
        $sql = "SELECT * FROM portfolio_projects";
        if ($category) {
            $sql .= " WHERE category = :category";
        }
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        if ($category) {
            $stmt->bindParam(':category', $category);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

function getProject($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM portfolio_projects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    } catch(PDOException $e) {
        return null;
    }
}

function addProject($data) {
    global $pdo;
    try {
        $sql = "INSERT INTO portfolio_projects (header, brief_info, tools_skills, banner_image_url, work_images, challenge, start_date, end_date, learning, website_link, category) 
                VALUES (:header, :brief_info, :tools_skills, :banner_image_url, :work_images, :challenge, :start_date, :end_date, :learning, :website_link, :category)";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':header' => $data['header'],
            ':brief_info' => $data['brief_info'],
            ':tools_skills' => $data['tools_skills'],
            ':banner_image_url' => $data['banner_image_url'],
            ':work_images' => json_encode($data['work_images'] ?? []),
            ':challenge' => $data['challenge'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':learning' => $data['learning'],
            ':website_link' => $data['website_link'],
            ':category' => $data['category']
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

function updateProject($id, $data) {
    global $pdo;
    try {
        $sql = "UPDATE portfolio_projects SET 
                header = :header, 
                brief_info = :brief_info, 
                tools_skills = :tools_skills, 
                banner_image_url = :banner_image_url, 
                work_images = :work_images, 
                challenge = :challenge, 
                start_date = :start_date, 
                end_date = :end_date, 
                learning = :learning, 
                website_link = :website_link, 
                category = :category,
                updated_at = NOW()
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':header' => $data['header'],
            ':brief_info' => $data['brief_info'],
            ':tools_skills' => $data['tools_skills'],
            ':banner_image_url' => $data['banner_image_url'],
            ':work_images' => json_encode($data['work_images'] ?? []),
            ':challenge' => $data['challenge'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':learning' => $data['learning'],
            ':website_link' => $data['website_link'],
            ':category' => $data['category']
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

function deleteProject($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM portfolio_projects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch(PDOException $e) {
        return false;
    }
}

function updateSettings($data) {
    global $pdo;
    try {
        // Delete existing settings first
        $pdo->exec("DELETE FROM site_settings");
        
        // Insert new settings
        $sql = "INSERT INTO site_settings (site_title, tagline, about_text, contact_email, profile_image_url, social_links) 
                VALUES (:site_title, :tagline, :about_text, :contact_email, :profile_image_url, :social_links)";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':site_title' => $data['site_title'],
            ':tagline' => $data['tagline'],
            ':about_text' => $data['about_text'],
            ':contact_email' => $data['contact_email'],
            ':profile_image_url' => $data['profile_image_url'],
            ':social_links' => json_encode($data['social_links'] ?? [])
        ]);
    } catch(PDOException $e) {
        error_log("Settings update error: " . $e->getMessage());
        return false;
    }
}

function uploadImage($file, $directory = 'uploads/') {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'message' => 'Invalid file type'];
    }
    
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File too large'];
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = $directory . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'filename' => $filename, 'filepath' => $filepath];
    }
    
    return ['success' => false, 'message' => 'Upload failed'];
}

function getSkills() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM skills ORDER BY category, skill_name");
        $skills = $stmt->fetchAll();
        $grouped = [];
        foreach ($skills as $skill) {
            $grouped[$skill['category']][] = $skill;
        }
        return $grouped;
    } catch(PDOException $e) {
        return [];
    }
}

function addSkill($data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO skills (category, skill_name, proficiency_level) VALUES (:category, :skill_name, :proficiency_level)");
        return $stmt->execute([
            ':category' => $data['category'],
            ':skill_name' => $data['skill_name'],
            ':proficiency_level' => $data['proficiency_level']
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

function deleteSkill($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM skills WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    } catch(PDOException $e) {
        return false;
    }
}

function getServices() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM services ORDER BY start_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

function addService($data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO services (company_name, designation, start_date, end_date, job_responsibility, location, employment_type) VALUES (:company_name, :designation, :start_date, :end_date, :job_responsibility, :location, :employment_type)");
        return $stmt->execute([
            ':company_name' => $data['company_name'],
            ':designation' => $data['designation'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'] ?: null,
            ':job_responsibility' => $data['job_responsibility'],
            ':location' => $data['location'],
            ':employment_type' => $data['employment_type']
        ]);
    } catch(PDOException $e) {
        return false;
    }
}

function deleteService($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    } catch(PDOException $e) {
        return false;
    }
}

function sendContactEmail($data) {
    $to = getSettings()['contact_email'];
    $subject = "Portfolio Contact: " . $data['subject'];
    $message = "Name: " . $data['name'] . "\n";
    $message .= "Email: " . $data['email'] . "\n\n";
    $message .= "Message:\n" . $data['message'];
    
    $headers = "From: " . $data['email'] . "\r\n";
    $headers .= "Reply-To: " . $data['email'] . "\r\n";
    
    return mail($to, $subject, $message, $headers);
}
?>