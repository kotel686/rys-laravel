<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Seed example news / aktuality posts for the Lezecká stěna mini-site.
 *
 * Idempotent: keyed on `slug` via `updateOrCreate`, so re-running the
 * seeder will not duplicate rows.
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
                'slug' => 'otevreni-nove-lezecke-steny',
                'title' => 'Otevřeli jsme novou lezeckou stěnu',
                'excerpt' => 'Po měsících příprav je tu velký den – naše lezecká stěna oficiálně otevírá své brány pro veřejnost.',
                'content' => <<<'HTML'
<p>Dlouho jsme se na tento okamžik těšili a teď je tu – <strong>lezecká stěna v Praze 5 je oficiálně otevřená</strong>. Připravili jsme pro Vás moderní zázemí, přes 100 cest, automatická jištění a kompletní půjčovnu vybavení.</p>

<h2>Co u nás najdete</h2>
<ul>
    <li>12 metrů vysokou stěnu s obtížnostmi 4 – 9 UIAA</li>
    <li>400 m² lezecké plochy se cestami pro úplné začátečníky i pokročilé</li>
    <li>Automatická jištění (auto-belay), takže si zalezete i sami</li>
    <li>Půjčovnu výstroje – lezeček, sedáků a jistítek</li>
</ul>

<h2>Otevírací doba</h2>
<p>Provoz jsme rozdělili tak, aby vyhovoval pracujícím i rodinám s dětmi:</p>
<ul>
    <li><strong>Pondělí – Pátek:</strong> 14:00 – 21:00</li>
    <li><strong>Sobota – Neděle:</strong> 10:00 – 20:00</li>
</ul>

<p>Těšíme se na Vás. Pokud byste si chtěli vyzkoušet lezení poprvé, ozvěte se nám – domluvíme úvodní instruktáž s certifikovaným trenérem.</p>
HTML,
                'published_at' => Carbon::now()->subDays(2),
            ],

            [
                'slug' => 'nabor-do-detskych-krouzku',
                'title' => 'Nábor do dětských kroužků na nové pololetí',
                'excerpt' => 'Otevíráme přihlášky do dětských lezeckých kroužků. Skupiny pro začátečníky i pokročilé, věkové kategorie 6 – 15 let.',
                'content' => <<<'HTML'
<p>Vyrostlo Vám doma nadšené dítě, které by chtělo lézt? <strong>Otevíráme nábor do dětských lezeckých kroužků</strong> na nové pololetí.</p>

<h2>Pro koho jsou kroužky</h2>
<p>Skupiny dělíme podle věku a úrovně:</p>
<ul>
    <li><strong>Mladší žáci (6 – 10 let)</strong> – základy lezení formou hry, hra na bezpečnost, koordinace</li>
    <li><strong>Starší žáci (11 – 15 let)</strong> – technika lezení, bouldering, první závody</li>
</ul>

<h2>Jak se přihlásit</h2>
<ol>
    <li>Vyplňte přihlášku na <a href="/lezeckastena/kontakt">kontaktní stránce</a> nebo zavolejte.</li>
    <li>Domluvíme s Vámi termín ukázkové lekce zdarma.</li>
    <li>Pokud Vás kroužek nadchne, zaplatíte pololetní kurzovné a jste v.</li>
</ol>

<p>Kapacita je omezená na <strong>8 dětí na trenéra</strong>, takže to s přihláškou neodkládejte. Ceník najdete na <a href="/lezeckastena/cenik">stránce Ceník</a>.</p>
HTML,
                'published_at' => Carbon::now()->subDays(7),
            ],

            [
                'slug' => 'tretí-misto-z-me-ve-villars',
                'title' => 'František Rys vybojoval bronz na ME v paralezení',
                'excerpt' => 'Náš hlavní trenér František Rys přivezl z ME v paralezení ve švýcarském Villars historickou medaili pro Českou republiku.',
                'content' => <<<'HTML'
<p>O víkendu se ve švýcarském Villars konalo Mistrovství Evropy v paralezení a <strong>František Rys</strong> – náš hlavní trenér – přivezl <strong>třetí místo</strong>. Je to historicky první medaile pro Českou republiku z mezinárodní soutěže v této disciplíně.</p>

<h2>Cesta k medaili</h2>
<p>František se účastnil kategorie pro lezce s pohybovým hendikepem. V kvalifikaci postoupil ze čtvrtého místa, ve finále si polepšil a obsadil stupínek vítězů.</p>

<blockquote>"Je to obrovský úspěch nejen pro mě, ale pro celou českou paralezeckou komunitu. Doufám, že to motivuje další lezce, aby se nebáli zkusit závodit."</blockquote>

<h2>Co bude dál</h2>
<p>Příští sezónu se František připravuje na <strong>Mistrovství světa</strong>. U nás na stěně mezitím trénuje další talentované paralezce – pokud máte zájem o tréninky uzpůsobené hendikepu, ozvěte se nám.</p>
HTML,
                'published_at' => Carbon::now()->subDays(14),
            ],

            [
                'slug' => 'vanocni-otviracky-doba-2026',
                'title' => 'Otevírací doba o Vánocích a Novém roce',
                'excerpt' => 'Sváteční režim na stěně – kdy máme zavřeno, kdy si naopak můžete přijít zalézt místo televize.',
                'content' => <<<'HTML'
<p>Blíží se konec roku a my pro Vás máme přehled <strong>otevírací doby o svátcích</strong>.</p>

<h2>Sváteční režim</h2>
<ul>
    <li><strong>24. 12. (Štědrý den)</strong> – zavřeno</li>
    <li><strong>25. – 26. 12.</strong> – zavřeno</li>
    <li><strong>27. – 30. 12.</strong> – otevřeno 10:00 – 18:00</li>
    <li><strong>31. 12. (Silvestr)</strong> – otevřeno 10:00 – 14:00</li>
    <li><strong>1. 1.</strong> – zavřeno</li>
    <li><strong>od 2. 1.</strong> – běžný provoz</li>
</ul>

<p>Pokud máte rádi lezení místo televizního maratonu, využijte mezisvátečních dnů – obvykle bývá u nás méně lidí, takže si pořádně zalezete bez fronty na cesty.</p>

<p>Hezké svátky a pevný úchop!</p>
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
