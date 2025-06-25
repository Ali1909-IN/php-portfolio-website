// Main JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Contact form submission
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Message sent successfully!', 'success');
                    contactForm.reset();
                } else {
                    showNotification(data.message || 'Failed to send message', 'error');
                }
            })
            .catch(error => {
                showNotification('An error occurred. Please try again.', 'error');
            });
        });
    }

    // Active navigation highlighting
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    function highlightNavigation() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-blue-600', 'dark:text-blue-400');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('text-blue-600', 'dark:text-blue-400');
            }
        });
    }

    window.addEventListener('scroll', highlightNavigation);
});

// Project modal functions
function openProjectModal(project) {
    const modal = document.getElementById('project-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');
    
    modalTitle.textContent = project.header;
    
    let workImages = '';
    if (project.work_images) {
        try {
            const images = JSON.parse(project.work_images);
            if (images.length > 0) {
                workImages = '<div class="grid grid-cols-2 gap-4 mb-6">';
                images.forEach(img => {
                    workImages += `<img src="${img}" alt="Project image" class="rounded-lg">`;
                });
                workImages += '</div>';
            }
        } catch (e) {
            // Handle parsing error
        }
    }
    
    modalContent.innerHTML = `
        <div class="space-y-6">
            ${project.banner_image_url ? `<img src="${project.banner_image_url}" alt="${project.header}" class="w-full rounded-lg">` : ''}
            
            <div class="flex items-center gap-4">
                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm rounded-full">
                    ${project.category}
                </span>
                ${project.start_date ? `<span class="text-slate-500 dark:text-slate-400">${project.start_date}</span>` : ''}
            </div>
            
            <p class="text-slate-600 dark:text-slate-300 text-lg">${project.brief_info || ''}</p>
            
            ${project.tools_skills ? `
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Technologies Used:</h4>
                    <div class="flex flex-wrap gap-2">
                        ${project.tools_skills.split(',').map(skill => 
                            `<span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm rounded">${skill.trim()}</span>`
                        ).join('')}
                    </div>
                </div>
            ` : ''}
            
            ${workImages}
            
            ${project.challenge ? `
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Challenge:</h4>
                    <p class="text-slate-600 dark:text-slate-300">${project.challenge}</p>
                </div>
            ` : ''}
            
            ${project.learning ? `
                <div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-2">What I Learned:</h4>
                    <p class="text-slate-600 dark:text-slate-300">${project.learning}</p>
                </div>
            ` : ''}
            
            ${project.website_link ? `
                <div>
                    <a href="${project.website_link}" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                        <i class="fas fa-external-link-alt"></i>
                        View Live Project
                    </a>
                </div>
            ` : ''}
        </div>
    `;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeProjectModal() {
    const modal = document.getElementById('project-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('project-modal');
    if (e.target === modal) {
        closeProjectModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProjectModal();
    }
});

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
    
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    notification.className += ` ${bgColor} text-white`;
    
    notification.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}