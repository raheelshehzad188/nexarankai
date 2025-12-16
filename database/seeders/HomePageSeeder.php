<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\Menu;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ClientLogo;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Site Settings
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_logo' => null, // Will be uploaded via admin
                'header_phone' => '+971 55 638 2341',
                'header_email' => 'info@proclean-ac.com',
                'header_cta_text' => 'Contact Us',
                'header_cta_link' => '/contact',
                'footer_text' => '<p>At Pro Clean AC our aim is to always provide the best value for money and the highest quality British standard of service.</p>',
                'social_links' => [
                    'facebook' => 'https://www.facebook.com/procleanac',
                    'instagram' => 'https://www.instagram.com/PROCLEANAC/',
                    'youtube' => 'https://www.youtube.com/channel/UCmF1TEQxv6tnX7-XA5k_jfw',
                ],
            ]
        );

        // 2. Create Home Page
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'meta_title' => 'AC Cleaning in Dubai - AC Duct Cleaning | Pro Clean AC',
                'meta_description' => 'Pro Clean AC delivers professional duct, coil cleaning and sanitisation services. Enjoy better performance and air quality for your comfort and well-being!',
                'status' => 'published',
            ]
        );

        // 3. Create Menu Items
        $menus = [
            ['title' => 'Home', 'location' => 'header', 'link_type' => 'page', 'page_id' => $homePage->id, 'url' => null, 'sort_order' => 1],
            ['title' => 'About', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '/about', 'sort_order' => 2],
            ['title' => 'Our Services', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '#Our-Services', 'sort_order' => 3],
            ['title' => 'Blog', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '/blog', 'sort_order' => 4],
            ['title' => 'Contact Us', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '/contact', 'sort_order' => 5],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['title' => $menu['title'], 'location' => $menu['location']],
                array_merge($menu, ['status' => true])
            );
        }

        // Footer Menus
        $footerMenus = [
            ['title' => 'Home', 'location' => 'footer', 'link_type' => 'page', 'page_id' => $homePage->id, 'url' => null, 'sort_order' => 1],
            ['title' => 'About Us', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/about', 'sort_order' => 2],
            ['title' => 'Our Services', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '#Our-Services', 'sort_order' => 3],
            ['title' => 'Blog', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/blog', 'sort_order' => 4],
            ['title' => 'Privacy Policy', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/privacy-policy', 'sort_order' => 5],
        ];

        foreach ($footerMenus as $menu) {
            Menu::updateOrCreate(
                ['title' => $menu['title'], 'location' => $menu['location']],
                array_merge($menu, ['status' => true])
            );
        }

        // 4. Create Services with images from HTML
        $services = [
            [
                'title' => 'Duct Cleaning',
                'description' => 'Professional air duct cleaning services to improve air quality and system efficiency.',
                'image' => 'imgs/60d0257c06d8357a4da9cdbe_duct-cleaning-services-dubai.jpg',
                'status' => true,
            ],
            [
                'title' => 'Sanitisation',
                'description' => 'Complete sanitisation services to eliminate bacteria, mold, and allergens from your AC system.',
                'image' => 'imgs/60d025dd148b7bdb892ca0d4_sanitation-services-dubai.jpg',
                'status' => true,
            ],
            [
                'title' => 'Coil Cleaning',
                'description' => 'Expert coil cleaning services to restore optimal cooling performance.',
                'image' => 'imgs/60d02614160952233be25651_coil-cleaning-services-dubai.jpg',
                'status' => true,
            ],
            [
                'title' => 'AC Cleaning',
                'description' => 'Comprehensive AC cleaning services for residential and commercial properties.',
                'image' => 'imgs/60d026582b49365b2459f742_ac-cleaning-services-dubai.jpg',
                'status' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }

        // 5. Create Testimonials
        $testimonials = [
            [
                'name' => 'Cassy H, JLT',
                'review' => 'Jamie and his team are always on time, transparent, responsive and clean after themselves',
                'rating' => 5,
                'status' => true,
            ],
            [
                'name' => 'Reham A, Dubai Marina',
                'review' => 'Amazing work done for our AC ducts. From cleaning to sanitation. The team was on time and did an outstanding job.',
                'rating' => 5,
                'status' => true,
            ],
            [
                'name' => 'Monique N, Arabian Ranches',
                'review' => 'Honestly I\'m so impressed I would definitely use them again and recommend to anyone in need of their services.',
                'rating' => 5,
                'status' => true,
            ],
            [
                'name' => 'Customer, Dubai',
                'review' => 'Amazing service! I have used multiple AC cleaning services during my 8 years in Dubai and this company are by far the best!',
                'rating' => 5,
                'status' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // 6. Create Client Logos (just placeholder data, images will be uploaded)
        $clientLogos = [
            ['name' => 'Zurich', 'logo' => null, 'status' => true],
            ['name' => 'Costa Coffee', 'logo' => null, 'status' => true],
            ['name' => 'Five', 'logo' => null, 'status' => true],
            ['name' => 'Merz', 'logo' => null, 'status' => true],
            ['name' => 'Rak Bank', 'logo' => null, 'status' => true],
        ];

        foreach ($clientLogos as $logo) {
            ClientLogo::updateOrCreate(
                ['name' => $logo['name']],
                $logo
            );
        }

        // 7. Create Page Sections for Home Page
        $sections = [
            [
                'page_id' => $homePage->id,
                'type' => 'video-hero',
                'data' => [
                    'video_source' => 'mp4',
                    'mp4_link' => 'https://cdn.prod.website-files.com/5f32dc8fbfcb095f82c1b9ec/60d1a0d2a9fad2bc8bc60d22_ProCleanAC-HomepageVideo-transcode-transcode.mp4',
                    'heading' => 'Pro Clean AC<br/>In Dubai.',
                    'short_detail' => 'At Pro Clean AC our aim is to always provide the best value for money and the highest quality British standard of service.',
                    'btn_text' => 'Contact us Now!',
                    'btn_link' => '/contact',
                ],
                'sort_order' => 0,
                'status' => true,
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'our-services',
                'data' => [
                    'short_heading' => 'Our Services',
                    'main_heading' => 'What Pro Clean AC can do for you.',
                    'service_ids' => Service::pluck('id')->toArray(), // All services
                ],
                'sort_order' => 1,
                'status' => true,
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'testimonials',
                'data' => [],
                'sort_order' => 2,
                'status' => true,
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'content',
                'data' => [
                    'content' => '<div class="container my-5">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>About Us</h4>
                                <p>At Pro Clean AC we use fully trained staff by British engineers who will turn up on time! Pro Clean AC engineers come fully equipped and can service your home, work or office with our industry leading Machines.</p>
                                <p>So for any air conditioning cleaning needs contact us for a prompt, professional & friendly service guaranteed!</p>
                            </div>
                            <div class="col-md-6">
                                <h4>We are NADCA Accredited</h4>
                                <p>Pro Clean AC is a member of the National Air Duct Cleaners Association (NADCA) and adheres to stringent industry standards and best practices in HVAC system cleaning and restoration.</p>
                            </div>
                        </div>
                    </div>',
                ],
                'sort_order' => 3,
                'status' => true,
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'clients',
                'data' => [],
                'sort_order' => 4,
                'status' => true,
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'faq',
                'data' => [
                    'faqs' => [
                        [
                            'question' => 'What services does Pro Clean AC offer?',
                            'answer' => 'Pro Clean AC specializes in professional air conditioning cleaning services, including comprehensive duct cleaning, coil cleaning, and filter cleaning, ensuring optimal air quality and efficient cooling for your space.',
                        ],
                        [
                            'question' => 'Why choose Pro Clean AC for AC cleaning?',
                            'answer' => 'We focus exclusively on cleaning to deliver expert-level services that enhance your AC system\'s performance and promote healthier indoor air quality.',
                        ],
                        [
                            'question' => 'How do I book an AC cleaning service?',
                            'answer' => 'You can book directly by calling our office, or reach out via email or WhatsApp.',
                        ],
                        [
                            'question' => 'What is the cost of AC cleaning?',
                            'answer' => 'Pricing depends on the number of AC units and the scope of cleaning required.',
                        ],
                        [
                            'question' => 'How long does an AC cleaning service take?',
                            'answer' => 'Cleaning times vary based on the size of property, number of AC units and which option you choose to proceed with.',
                        ],
                    ],
                ],
                'sort_order' => 5,
                'status' => true,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::updateOrCreate(
                [
                    'page_id' => $section['page_id'],
                    'type' => $section['type'],
                    'sort_order' => $section['sort_order'],
                ],
                $section
            );
        }

        $this->command->info('Home page, menus, settings, services, testimonials, and sections created successfully!');
    }
}

