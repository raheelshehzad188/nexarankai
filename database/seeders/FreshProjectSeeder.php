<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionType;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FreshProjectSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@clean-air.ae',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        SiteSetting::query()->delete();
        SiteSetting::create([
            'site_name' => 'Irhas',
            'header_phone' => '+62 800 1402',
            'header_email' => 'info@irhas.com',
            'site_address' => 'Jakarta, Indonesia',
            'header_cta_text' => 'Get Started',
            'header_cta_link' => '#',
            'footer_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore. Nam tincidunt, tellus quis maximus consequat. et malesuada nibh lorem vel.',
            'social_links' => [
                ['platform' => 'facebook', 'url' => '#'],
                ['platform' => 'instagram', 'url' => '#'],
                ['platform' => 'youtube', 'url' => '#'],
            ],
        ]);

        SectionType::query()->delete();

        $sectionTypes = [
            ['slug' => 'irhas-about', 'name' => 'Irhas - About'],
            ['slug' => 'irhas-portfolio', 'name' => 'Irhas - Portfolio'],
            ['slug' => 'irhas-services', 'name' => 'Irhas - Services'],
            ['slug' => 'irhas-testimonial', 'name' => 'Irhas - Testimonial'],
            ['slug' => 'irhas-counter', 'name' => 'Irhas - Counter'],
            ['slug' => 'irhas-blog', 'name' => 'Irhas - Blog'],
            ['slug' => 'irhas-services-list', 'name' => 'Irhas - All Services Page'],
            ['slug' => 'irhas-blog-list', 'name' => 'Irhas - All Blog Posts Page'],
            ['slug' => 'irhas-contact', 'name' => 'Irhas - Contact Page'],
            ['slug' => 'new-design-privacy-hero', 'name' => 'New design - Privacy Hero'],
            ['slug' => 'new-design-privacy-content', 'name' => 'New design - Privacy Content'],
        ];

        foreach ($sectionTypes as $index => $type) {
            SectionType::create([
                'slug' => $type['slug'],
                'name' => $type['name'],
                'description' => $type['name'] . ' section.',
                'status' => true,
                'sort_order' => $index + 1,
            ]);
        }

        PageSection::query()->delete();
        Page::query()->delete();
        Menu::query()->delete();
        Service::query()->delete();
        ServiceCategory::query()->delete();
        BlogPost::query()->delete();
        BlogCategory::query()->delete();

        $homePage = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'meta_title' => 'Irhas | Crafting Digital Experiences',
            'meta_description' => 'Irhas Home 3 — Crafting Digital Experiences.',
            'status' => 'published',
            'use_new_layout' => false,
            'use_irhas_layout' => true,
        ]);

        $privacyPage = Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'meta_title' => 'Privacy Policy - Irhas',
            'meta_description' => 'Privacy Policy for Irhas.',
            'status' => 'published',
            'use_new_layout' => true,
            'use_irhas_layout' => false,
        ]);

        $servicesPage = Page::create([
            'title' => 'Services',
            'slug' => 'services',
            'meta_title' => 'Our Services - Irhas',
            'meta_description' => 'Browse all services offered by Irhas. Professional solutions for your business.',
            'meta_keywords' => 'services, irhas, business services',
            'status' => 'published',
            'use_new_layout' => false,
            'use_irhas_layout' => true,
        ]);

        PageSection::create([
            'page_id' => $servicesPage->id,
            'type' => 'irhas-services-list',
            'data' => config('irhas_defaults.irhas-services-list', []),
            'sort_order' => 1,
            'status' => true,
        ]);

        $blogPage = Page::create([
            'title' => 'Blog',
            'slug' => 'blog',
            'meta_title' => 'Our Blog - Irhas',
            'meta_description' => 'Latest news, tips and insights from Irhas.',
            'meta_keywords' => 'blog, news, irhas, tips',
            'status' => 'published',
            'use_new_layout' => false,
            'use_irhas_layout' => true,
        ]);

        PageSection::create([
            'page_id' => $blogPage->id,
            'type' => 'irhas-blog-list',
            'data' => config('irhas_defaults.irhas-blog-list', []),
            'sort_order' => 1,
            'status' => true,
        ]);

        $contactPage = Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'meta_title' => 'Contact Us - Irhas',
            'meta_description' => 'Get in touch with Irhas. Contact us for services, support, or inquiries.',
            'meta_keywords' => 'contact, irhas, get in touch',
            'status' => 'published',
            'use_new_layout' => false,
            'use_irhas_layout' => true,
        ]);

        PageSection::create([
            'page_id' => $contactPage->id,
            'type' => 'irhas-contact',
            'data' => config('irhas_defaults.irhas-contact', []),
            'sort_order' => 1,
            'status' => true,
        ]);

        $homeSections = [
            'irhas-about',
            'irhas-portfolio',
            'irhas-services',
            'irhas-testimonial',
            'irhas-counter',
            'irhas-blog',
        ];

        foreach ($homeSections as $index => $slug) {
            PageSection::create([
                'page_id' => $homePage->id,
                'type' => $slug,
                'data' => config('irhas_defaults.' . $slug, []),
                'sort_order' => $index + 1,
                'status' => true,
            ]);
        }

        foreach (['new-design-privacy-hero', 'new-design-privacy-content'] as $index => $slug) {
            PageSection::create([
                'page_id' => $privacyPage->id,
                'type' => $slug,
                'data' => config('new_design_defaults.' . $slug, []),
                'sort_order' => $index + 1,
                'status' => true,
            ]);
        }

        $menus = [
            ['title' => 'Home', 'location' => 'header', 'link_type' => 'page', 'page_id' => $homePage->id, 'url' => null, 'sort_order' => 1],
            ['title' => 'Project', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '#', 'sort_order' => 2],
            ['title' => 'Service', 'location' => 'header', 'link_type' => 'page', 'page_id' => $servicesPage->id, 'url' => null, 'sort_order' => 3],
            ['title' => 'About', 'location' => 'header', 'link_type' => 'custom', 'page_id' => null, 'url' => '#', 'sort_order' => 4],
            ['title' => 'Blog', 'location' => 'header', 'link_type' => 'page', 'page_id' => $blogPage->id, 'url' => null, 'sort_order' => 5],
            ['title' => 'Contact', 'location' => 'header', 'link_type' => 'page', 'page_id' => $contactPage->id, 'url' => null, 'sort_order' => 6],
            ['title' => 'Referral Service Management', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/services/referral-service-management', 'sort_order' => 1],
            ['title' => 'Personal Service Development', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/services/personal-service-development', 'sort_order' => 2],
            ['title' => 'Strategy Business Management', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/services/strategy-business-management', 'sort_order' => 3],
            ['title' => 'Partnership Quality Member', 'location' => 'footer', 'link_type' => 'custom', 'page_id' => null, 'url' => '/services/partnership-quality-member', 'sort_order' => 4],
        ];

        foreach ($menus as $menu) {
            Menu::create(array_merge($menu, ['status' => true]));
        }

        $categories = [
            ['name' => 'Government', 'slug' => 'government', 'sort_order' => 1],
            ['name' => 'Creative', 'slug' => 'creative', 'sort_order' => 2],
            ['name' => 'Advertising', 'slug' => 'advertising', 'sort_order' => 3],
            ['name' => 'Marketing', 'slug' => 'marketing', 'sort_order' => 4],
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            $categoryIds[$cat['slug']] = ServiceCategory::create(array_merge($cat, ['status' => true]))->id;
        }

        $services = [
            [
                'title' => 'Referral Service Management',
                'slug' => 'referral-service-management',
                'service_category_id' => $categoryIds['government'],
                'excerpt' => 'The safe he to for the calculus tone the continued too a long occupied front are I feedback.',
                'content' => '<p>With our of maybe few forwards, five nor treat were far getting he allowed sentences leaving because not her to business, myself is agency the been in alarm someone hired those much would arrange had reedy.</p><p>With distance by synthesizers films now, half and, and have to the phase word fundamentals just beings all and by intermixing if village phase turner as with typically that and subjective poverty he place watching lowest avoided sleep no to of nothing just but this reassuring destined evils harder universal for room.</p>',
                'image' => null,
                'content_image' => null,
                'published_at' => '2020-07-27',
                'sort_order' => 1,
                'features_section_title' => 'We are Establish Company for It Business',
                'accordions' => [
                    ['title' => 'Best For Consulting', 'content' => 'You who we\'ve saw of to and get would to and among we presented that a to the legs, however problem. With we a by generally at are duties a not in yet on researches picture luxury.'],
                    ['title' => 'Security Systems', 'content' => 'Distance, just voices from bidding of transactions imitation; Of on not ability mountains, his was have much I either there she suspicious her honour.'],
                    ['title' => 'Digital Solutions Agency', 'content' => 'Employed parents to much height real of should is but between the rome; Out that, white room it after that the instead for different last analyzed each handwriting abundantly.'],
                ],
                'sidebar_testimonials' => [
                    ['author' => 'Cristopher Halsey', 'job' => 'Assistant', 'quote' => 'For and any counter. Too had means, his films experience a in nor be different and when show I point the then, and learn planning poster show she recommended.', 'image' => 'img/testimonial-profile.png'],
                    ['author' => 'Eliana Chapman', 'job' => 'Digital Designer', 'quote' => 'Your of because were progress the first are of times screen. The of carried shudder.', 'image' => 'img/testimonial-profile.png'],
                ],
                'meta_title' => 'Referral Service Management - Irhas',
                'meta_description' => 'Professional referral service management solutions by Irhas.',
                'status' => true,
            ],
            [
                'title' => 'Personal Service Development',
                'slug' => 'personal-service-development',
                'service_category_id' => $categoryIds['creative'],
                'excerpt' => 'Personal service development tailored for creative businesses.',
                'content' => '<p>Ever starting it the them it caught parameters ever would as to thousands consider sentences gradual great studies.</p>',
                'published_at' => now(),
                'sort_order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Strategy Business Management',
                'slug' => 'strategy-business-management',
                'service_category_id' => $categoryIds['creative'],
                'excerpt' => 'Strategy and business management consulting services.',
                'content' => '<p>Strategy business management for growing companies and startups.</p>',
                'published_at' => now(),
                'sort_order' => 3,
                'status' => true,
            ],
            [
                'title' => 'Partnership Quality Member',
                'slug' => 'partnership-quality-member',
                'service_category_id' => $categoryIds['advertising'],
                'excerpt' => 'Partnership quality member programs for your organization.',
                'content' => '<p>Build quality partnerships with our member programs.</p>',
                'published_at' => now(),
                'sort_order' => 4,
                'status' => true,
            ],
        ];

        foreach ($services as $data) {
            Service::create($data);
        }

        $blogCategories = [
            ['name' => 'Business', 'slug' => 'business', 'sort_order' => 1],
            ['name' => 'Tips', 'slug' => 'tips', 'sort_order' => 2],
            ['name' => 'Educate', 'slug' => 'educate', 'sort_order' => 3],
        ];

        $blogCatIds = [];
        foreach ($blogCategories as $cat) {
            $blogCatIds[$cat['slug']] = BlogCategory::create(array_merge($cat, ['status' => true]))->id;
        }

        $posts = [
            [
                'title' => 'How to surviving on the great industry age',
                'slug' => 'how-to-surviving-on-the-great-industry-age',
                'excerpt' => 'Tips for thriving in a competitive digital industry landscape.',
                'content' => '<p>It a monitor lie agency, all been evening. It right called phase boa however of the city the over had the play.</p><blockquote><p>Upper to I to enjoying this roman conduct, a for to but I it duty we’ve boa he can in he to was long be economic her supplies.</p></blockquote><p>Even the should you equally train the move fortune.</p>',
                'author_name' => 'Daniel Zedda',
                'author_role' => 'Author',
                'author_bio' => 'Digital strategist and content creator with years of industry experience.',
                'tags' => ['Agency', 'Business', 'Industry'],
                'published_at' => now()->subDays(10),
                'meta_title' => 'How to surviving on the great industry age - Irhas Blog',
                'meta_description' => 'Learn how to survive and thrive in the great industry age with practical tips.',
                'status' => true,
                'categories' => ['business', 'tips'],
            ],
            [
                'title' => 'Teamwork as a team is the best way to do the job',
                'slug' => 'teamwork-as-a-team-is-the-best-way-to-do-the-job',
                'excerpt' => 'Why collaboration beats working alone every time.',
                'content' => '<p>Your of because were progress the first are of times screen. The of carried shudder.</p>',
                'author_name' => 'Daniel Zedda',
                'author_role' => 'Author',
                'tags' => ['Teamwork', 'Tips'],
                'published_at' => now()->subDays(7),
                'status' => true,
                'categories' => ['educate', 'tips'],
            ],
            [
                'title' => 'Work as efficient as you can to make things a lot easier',
                'slug' => 'work-as-efficient-as-you-can',
                'excerpt' => 'Efficiency strategies for modern teams.',
                'content' => '<p>Tickets no would or was past, behind future have be his I tone maybe had of in together were the with same decided put not allpowerful create rationalize it at to should, relief.</p>',
                'author_name' => 'Daniel Zedda',
                'author_role' => 'Author',
                'published_at' => now()->subDays(3),
                'status' => true,
                'categories' => ['educate'],
            ],
            [
                'title' => 'A tidy workplace is always making it more enjoyable',
                'slug' => 'a-tidy-workplace-is-always-making-it-more-enjoyable',
                'excerpt' => 'Organization tips for a productive workspace.',
                'content' => '<p>For and any counter. Too had means, his films experience a in nor be different and when show I point the then.</p>',
                'author_name' => 'Daniel Zedda',
                'author_role' => 'Author',
                'published_at' => now()->subDay(),
                'status' => true,
                'categories' => ['educate', 'tips'],
            ],
        ];

        foreach ($posts as $data) {
            $categorySlugs = $data['categories'];
            unset($data['categories']);
            $post = BlogPost::create($data);
            $post->categories()->sync(array_map(fn ($s) => $blogCatIds[$s], $categorySlugs));
        }

        $this->command?->info('Fresh project seeded: home, services, blog, 4 posts, privacy page.');
        $this->command?->info('Admin login: admin@clean-air.ae / password');
    }
}
