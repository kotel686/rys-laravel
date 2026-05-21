<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Seed example news / aktuality posts for the Lezecká stěna mini-site.
 *
 * All text is Lorem ipsum placeholder. Idempotent: keyed on `slug`.
 */
class ClimbingPostSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{slug:string,title:string,excerpt:string,content:string,published_at:Carbon}> $posts */
        $posts = [
            [
                'slug' => 'lorem-ipsum-1',
                'title' => 'Lorem ipsum dolor sit amet',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'content' => <<<'HTML'
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <strong>Ut enim ad minim veniam</strong>, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<h2>Lorem ipsum dolor</h2>
<ul>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Consectetur adipiscing elit</li>
    <li>Sed do eiusmod tempor incididunt</li>
    <li>Ut labore et dolore magna aliqua</li>
</ul>

<h2>Sed do eiusmod</h2>
<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur:</p>
<ul>
    <li><strong>Excepteur:</strong> sint occaecat cupidatat non proident</li>
    <li><strong>Officia:</strong> deserunt mollit anim id est laborum</li>
</ul>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
HTML,
                'published_at' => Carbon::now()->subDays(2),
            ],

            [
                'slug' => 'lorem-ipsum-2',
                'title' => 'Consectetur adipiscing elit',
                'excerpt' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'content' => <<<'HTML'
<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <strong>Excepteur sint occaecat</strong> cupidatat non proident.</p>

<h2>Sed ut perspiciatis</h2>
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam:</p>
<ul>
    <li>Lorem ipsum dolor sit amet 1</li>
    <li>Lorem ipsum dolor sit amet 2</li>
</ul>

<h2>Ut enim ad minim</h2>
<ol>
    <li>Eaque ipsa quae ab illo inventore veritatis</li>
    <li>Quasi architecto beatae vitae dicta sunt</li>
    <li>Nemo enim ipsam voluptatem quia voluptas</li>
</ol>

<p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
HTML,
                'published_at' => Carbon::now()->subDays(7),
            ],

            [
                'slug' => 'lorem-ipsum-3',
                'title' => 'Sed do eiusmod tempor incididunt',
                'excerpt' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'content' => <<<'HTML'
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium <strong>doloremque laudantium</strong>, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>

<h2>Nemo enim ipsam</h2>
<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos.</p>

<blockquote>"Lorem ipsum dolor sit amet, consectetur adipiscing elit – sed quia non numquam eius modi tempora incidunt."</blockquote>

<h2>Ut labore et dolore</h2>
<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
HTML,
                'published_at' => Carbon::now()->subDays(14),
            ],

            [
                'slug' => 'lorem-ipsum-4',
                'title' => 'Excepteur sint occaecat cupidatat',
                'excerpt' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
                'content' => <<<'HTML'
<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>

<h2>Vel illum qui dolorem</h2>
<ul>
    <li><strong>Lorem ipsum 1</strong> – dolor sit amet consectetur</li>
    <li><strong>Lorem ipsum 2</strong> – adipiscing elit sed do eiusmod</li>
    <li><strong>Lorem ipsum 3</strong> – tempor incididunt ut labore</li>
    <li><strong>Lorem ipsum 4</strong> – et dolore magna aliqua</li>
</ul>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>
HTML,
                'published_at' => Carbon::now()->subDays(30),
            ],
        ];

        foreach ($posts as $post) {
            ClimbingPost::query()->updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'published_at' => $post['published_at'],
                    'is_published' => true,
                ],
            );
        }
    }
}
