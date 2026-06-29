<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Avatar;
use App\Models\ParentProfile;
use App\Models\Child;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Cute Avatars
        $avatarSvgs = [
            'pihu' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#FFE5EC" stroke="#FF4D80" stroke-width="2"/><circle cx="20" cy="30" r="14" fill="#4A2511"/><circle cx="80" cy="30" r="14" fill="#4A2511"/><circle cx="23" cy="36" r="4" fill="#FF4D80"/><circle cx="77" cy="36" r="4" fill="#FF4D80"/><circle cx="50" cy="52" r="30" fill="#FFD5C6"/><path d="M 23 45 Q 50 25 77 45 Q 50 35 23 45 Z" fill="#4A2511"/><circle cx="42" cy="52" r="3" fill="#222"/><circle cx="58" cy="52" r="3" fill="#222"/><circle cx="36" cy="60" r="4" fill="#FF9EAA" opacity="0.6"/><circle cx="64" cy="60" r="4" fill="#FF9EAA" opacity="0.6"/><path d="M 45 62 Q 50 67 55 62" stroke="#222" stroke-width="2" stroke-linecap="round" fill="none"/></svg>',
            'boy' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#E8F0FE" stroke="#4285F4" stroke-width="2"/><circle cx="50" cy="52" r="30" fill="#FFD5C6"/><path d="M 20 40 Q 50 15 80 40 Q 75 30 65 28 Q 50 20 35 28 Q 25 30 20 40 Z" fill="#2C1D11"/><path d="M 30 35 L 40 45 L 45 35 L 55 45 L 60 35 L 70 45" stroke="#2C1D11" stroke-width="4" stroke-linecap="round"/><circle cx="42" cy="52" r="3" fill="#222"/><circle cx="58" cy="52" r="3" fill="#222"/><circle cx="36" cy="60" r="3" fill="#FF9EAA" opacity="0.5"/><circle cx="64" cy="60" r="3" fill="#FF9EAA" opacity="0.5"/><path d="M 45 62 Q 50 67 55 62" stroke="#222" stroke-width="2" stroke-linecap="round" fill="none"/></svg>',
            'bunny' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#FCF0E3" stroke="#ED7D31" stroke-width="2"/><ellipse cx="38" cy="26" rx="8" ry="20" fill="#FFF" stroke="#222" stroke-width="2" transform="rotate(-10, 38, 26)"/><ellipse cx="62" cy="26" rx="8" ry="20" fill="#FFF" stroke="#222" stroke-width="2" transform="rotate(10, 62, 26)"/><ellipse cx="38" cy="26" rx="4" ry="14" fill="#FFB7B2" transform="rotate(-10, 38, 26)"/><ellipse cx="62" cy="26" rx="4" ry="14" fill="#FFB7B2" transform="rotate(10, 62, 26)"/><circle cx="50" cy="60" r="26" fill="#FFF" stroke="#222" stroke-width="2"/><circle cx="42" cy="56" r="3" fill="#222"/><circle cx="58" cy="56" r="3" fill="#222"/><circle cx="34" cy="64" r="3" fill="#FF9EAA" opacity="0.6"/><circle cx="66" cy="64" r="3" fill="#FF9EAA" opacity="0.6"/><path d="M 48 62 Q 50 60 52 62" stroke="#222" stroke-width="2" fill="none"/><path d="M 46 65 Q 50 69 54 65" stroke="#222" stroke-width="2" stroke-linecap="round" fill="none"/></svg>',
            'kitty' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#FFF0F5" stroke="#D15FEE" stroke-width="2"/><polygon points="22,45 28,18 45,35" fill="#E6A8D7" stroke="#222" stroke-width="2"/><polygon points="78,45 72,18 55,35" fill="#E6A8D7" stroke="#222" stroke-width="2"/><polygon points="26,40 30,22 41,33" fill="#FFB7B2"/><polygon points="74,40 70,22 59,33" fill="#FFB7B2"/><circle cx="50" cy="56" r="26" fill="#FFF" stroke="#222" stroke-width="2"/><circle cx="41" cy="52" r="3" fill="#222"/><circle cx="59" cy="52" r="3" fill="#222"/><ellipse cx="50" cy="58" rx="3" ry="2" fill="#FF8E8E"/><path d="M 46 62 Q 50 65 54 62" stroke="#222" stroke-width="2" stroke-linecap="round" fill="none"/><line x1="20" y1="56" x2="32" y2="58" stroke="#222" stroke-width="2" stroke-linecap="round"/><line x1="21" y1="62" x2="31" y2="62" stroke="#222" stroke-width="2" stroke-linecap="round"/><line x1="80" y1="56" x2="68" y2="58" stroke="#222" stroke-width="2" stroke-linecap="round"/><line x1="79" y1="62" x2="69" y2="62" stroke="#222" stroke-width="2" stroke-linecap="round"/></svg>',
            'panda' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#E2F0D9" stroke="#385723" stroke-width="2"/><circle cx="30" cy="30" r="12" fill="#222"/><circle cx="70" cy="30" r="12" fill="#222"/><circle cx="30" cy="30" r="6" fill="#FF9EAA"/><circle cx="70" cy="30" r="6" fill="#FF9EAA"/><circle cx="50" cy="55" r="28" fill="#FFF" stroke="#222" stroke-width="2"/><ellipse cx="40" cy="52" rx="7" ry="9" fill="#222" transform="rotate(-15, 40, 52)"/><ellipse cx="60" cy="52" rx="7" ry="9" fill="#222" transform="rotate(15, 60, 52)"/><circle cx="40" cy="50" r="2.5" fill="#FFF"/><circle cx="60" cy="50" r="2.5" fill="#FFF"/><polygon points="47,59 53,59 50,62" fill="#222"/><path d="M 46 64 Q 50 67 54 64" stroke="#222" stroke-width="2" stroke-linecap="round" fill="none"/></svg>',
            'lion' => '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="48" fill="#FFF9E6" stroke="#FFC000" stroke-width="2"/><circle cx="50" cy="52" r="32" fill="#FF6F00"/><circle cx="30" cy="32" r="10" fill="#FF6F00"/><circle cx="70" cy="32" r="10" fill="#FF6F00"/><circle cx="24" cy="52" r="10" fill="#FF6F00"/><circle cx="76" cy="52" r="10" fill="#FF6F00"/><circle cx="30" cy="72" r="10" fill="#FF6F00"/><circle cx="70" cy="72" r="10" fill="#FF6F00"/><circle cx="50" cy="80" r="10" fill="#FF6F00"/><circle cx="50" cy="54" r="23" fill="#FFD24C"/><circle cx="43" cy="50" r="3" fill="#222"/><circle cx="57" cy="50" r="3" fill="#222"/><polygon points="47,56 53,56 50,59" fill="#8B4513"/><path d="M 46 62 Q 50 65 54 62" stroke="#8B4513" stroke-width="2" stroke-linecap="round" fill="none"/></svg>'
        ];

        $avatarModels = [];
        foreach ($avatarSvgs as $name => $svg) {
            $avatarModels[$name] = Avatar::create([
                'name' => ucfirst($name),
                'svg_markup' => $svg
            ]);
        }

        // 2. Seed Default Parent User
        $parentUser = User::create([
            'name' => 'Parent Pihu',
            'email' => 'parent@kuhu.com',
            'username' => 'parent',
            'password' => Hash::make('password'),
            'role' => 'parent',
        ]);

        $parentProfile = ParentProfile::create([
            'user_id' => $parentUser->id,
            'phone' => '9876543210',
            'subscription_status' => 'free',
            'parent_pin' => '1234',
        ]);

        // 3. Seed Default Child Pihu (with 1250 stars as in design)
        $childPihu = Child::create([
            'parent_id' => $parentProfile->id,
            'user_id' => null,
            'name' => 'Pihu',
            'avatar_id' => $avatarModels['pihu']->id,
            'streak' => 5,
            'xp' => 450,
            'stars' => 1250,
            'coins' => 380,
            'level' => 1,
            'age' => 5,
            'last_active_at' => now(),
            'current_outfit' => 'default'
        ]);

        // Seed another child as well for switching demonstrations
        $childAarav = Child::create([
            'parent_id' => $parentProfile->id,
            'user_id' => null,
            'name' => 'Aarav',
            'avatar_id' => $avatarModels['boy']->id,
            'streak' => 2,
            'xp' => 150,
            'stars' => 320,
            'coins' => 100,
            'level' => 1,
            'age' => 4,
            'last_active_at' => now()->subDay(),
            'current_outfit' => 'default'
        ]);

        // 4. Seed Course Categories and Content
        // A. English Rhymes
        $engRhymes = Course::create([
            'title' => 'English Rhymes',
            'slug' => 'english-rhymes',
            'description' => 'Sing along with sweet English nursery rhymes!',
            'category' => 'Rhymes',
            'icon' => 'trophy',
            'bg_color' => '#FF4D80',
            'is_active' => true,
        ]);

        $rhymesData = [
            [
                'title' => 'Twinkle Twinkle Little Star',
                'body' => "Twinkle, twinkle, little star,\nHow I wonder what you are!\nUp above the world so high,\nLike a diamond in the sky.",
            ],
            [
                'title' => 'Humpty Dumpty Sat on a Wall',
                'body' => "Humpty Dumpty sat on a wall,\nHumpty Dumpty had a great fall.\nAll the king's horses and all the king's men,\nCouldn't put Humpty together again.",
            ],
            [
                'title' => 'Ba Ba Black Sheep',
                'body' => "Baa, baa, black sheep, have you any wool?\nYes, sir, yes, sir, three bags full.\nOne for the master, and one for the dame,\nAnd one for the little boy who lives down the lane.",
            ]
        ];

        foreach ($rhymesData as $idx => $rhyme) {
            Lesson::create([
                'course_id' => $engRhymes->id,
                'title' => $rhyme['title'],
                'content_type' => 'rhyme',
                'body_content' => $rhyme['body'],
                'sorting_order' => $idx,
            ]);
        }

        // B. Hindi Rhymes
        $hindiRhymes = Course::create([
            'title' => 'Hindi Rhymes',
            'slug' => 'hindi-rhymes',
            'description' => 'मजेदार हिंदी कविताएँ सीखें और गाएं!',
            'category' => 'Hindi',
            'icon' => 'music',
            'bg_color' => '#12B0C5',
            'is_active' => true,
        ]);

        $hindiRhymesData = [
            [
                'title' => 'मछली जल की रानी है',
                'body' => "मछली जल की रानी है, जीवन उसका पानी है।\nहाथ लगाओ तो डर जाएगी, बाहर निकालो तो मर जाएगी।\nपानी में डालो तो तैर जाएगी, सारा पानी पी जाएगी।",
            ],
            [
                'title' => 'चंदा मामा दूर के',
                'body' => "चंदा मामा दूर के, पुए पकाएं बूर के।\nआप खाएं थाली में, मुन्ने को दें प्याली में।\nप्याली गई टूट, मुन्ना गया रूठ।\nलाएंगे नई प्यालियां, बजा बजा के तालियां!",
            ],
            [
                'title' => 'तीतर और बटेर',
                'body' => "एक तीतर एक बटेर, दोनों मिलकर लड़ते शेर।\nलड़ते लड़ते थक गए दोनों, पिंजरे में जा बैठे दोनों।",
            ]
        ];

        foreach ($hindiRhymesData as $idx => $rhyme) {
            Lesson::create([
                'course_id' => $hindiRhymes->id,
                'title' => $rhyme['title'],
                'content_type' => 'rhyme',
                'body_content' => $rhyme['body'],
                'sorting_order' => $idx,
            ]);
        }

        // C. Devotional Learning
        $devotional = Course::create([
            'title' => 'Devotional Learning',
            'slug' => 'devotional-learning',
            'description' => 'Learn holy Mantras, Shlokas and stories!',
            'category' => 'Stories',
            'icon' => 'om',
            'bg_color' => '#6A4DFF',
            'is_active' => true,
        ]);

        $devotionalData = [
            // --- MANTRAS ---
            [
                'title' => 'Gayatri Mantra',
                'type' => 'mantra',
                'body' => "ॐ भूर्भुवः स्वः\nतत्सवितुर्वरेण्यं\nभर्गो देवस्य धीमहि\nधियो यो नः प्रचोदयात् ॥\n\nMeaning: We meditate on the glory of that Creator; Who has created the Universe; Who is worthy of Worship; Who is the Embodiment of Knowledge and Light; Who is the Remover of all Sin and Ignorance; May He enlighten our Intellect.",
            ],
            [
                'title' => 'Mahamrityunjaya Mantra',
                'type' => 'mantra',
                'body' => "ॐ त्र्यम्बकं यजामहे सुगन्धिं पुष्टिवर्धनम्।\nउर्वारुकमिव बन्धनान्मृत्योर्मुक्षीय माऽमृतात्॥\n\nMeaning: We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings. May He liberate us from death, like a ripe cucumber is separated from its vine, and lead us to immortality.",
            ],
            [
                'title' => 'Ganesh Mantra',
                'type' => 'mantra',
                'body' => "वक्रतुण्ड महाकाय सूर्यकोटि समप्रभ।\nनिर्विघ्नं कुरु मे देव सर्वकार्येषु सर्वदा॥\n\nMeaning: O Lord Ganesha, with a curved trunk and a huge body, possessing the brilliance of millions of suns, please make all my works free of obstacles, always.",
            ],
            [
                'title' => 'Hare Krishna Maha Mantra',
                'type' => 'mantra',
                'body' => "हरे कृष्ण हरे कृष्ण कृष्ण कृष्ण हरे हरे।\nहरे राम हरे राम राम राम हरे हरे॥\n\nMeaning: A powerful chant for peace and joy, calling upon Lord Krishna and Lord Rama to fill our hearts with divine love, peace, and positive energy.",
            ],
            [
                'title' => 'Saraswati Mantra',
                'type' => 'mantra',
                'body' => "सरस्वती नमस्तुभ्यं वरदे कामरूपिणी।\nविद्यारम्भं करिष्यामी सिद्धिर्भवतु मे सदा॥\n\nMeaning: O Goddess Saraswati, my humble salutations to you. You are the giver of wishes and blessings. As I begin my studies, please bless me with knowledge and success always.",
            ],
            [
                'title' => 'Guru Mantra',
                'type' => 'mantra',
                'body' => "गुरुर्ब्रह्मा गुरुर्विष्णुः गुरुर्देवो महेश्वरः।\nगुरुः साक्षात् परब्रह्म तस्मै श्रीगुरवे नमः॥\n\nMeaning: The teacher (Guru) is like Brahma (the Creator), Vishnu (the Preserver), and Maheshwara (Lord Shiva, the Destroyer). The Guru is the supreme reality standing right before us. Salutations to that revered Guru.",
            ],

            // --- AARTIS ---
            [
                'title' => 'Ganesh Aarti',
                'type' => 'aarti',
                'body' => "जय गणेश जय गणेश जय गणेश देवा ।\nमाता जाकी पार्वती पिता महादेवा ॥\nएक दन्त दयावन्त चार भुजा धारी ।\nमाथे सिन्दूर सोहे मूसे की सवारी ॥\n\nपान चढ़े फूल चढ़े और चढ़े मेवा ।\nलड्डुअन का भोग लगे सन्त करें सेवा ॥\nजय गणेश जय गणेश जय गणेश देवा ।\nमाता जाकी पार्वती पिता महादेवा ॥",
            ],
            [
                'title' => 'Om Jai Jagdish Hare',
                'type' => 'aarti',
                'body' => "ॐ जय जगदीश हरे, स्वामी जय जगदीश हरे ।\nभक्त जनों के संकट, क्षण में दूर करे ॥ ॐ जय...\n\nतन-मन-धन सब है तेरा, स्वामी सब कुछ है तेरा ।\nतेरा तुझको अर्पण, क्या लागे मेरा ॥ ॐ जय...\n\nMeaning: O Lord of the Universe, please remove the troubles of your devotees in a second. Everything I have belongs to You; I offer it back to You, as nothing is truly mine.",
            ],
            [
                'title' => 'Hanuman Aarti',
                'type' => 'aarti',
                'body' => "आरती कीजै हनुमान लला की। दुष्ट दलन रघुनाथ कला की॥\nजाके बल से गिरिवर कांपे। रोग दोष जाके निकट न झांपे॥\n\nअंजनी पुत्र महा बलदाई। सन्तन के प्रभु सदा सहाई॥\nआरती कीजै हनुमान लला की। दुष्ट दलन रघुनाथ कला की॥\n\nMeaning: Let us perform the Aarti of the beloved Lord Hanuman, the destroyer of evil forces. His strength makes even mountains shake, and no illness or sorrow can come near him.",
            ],
            [
                'title' => 'Shiva Aarti',
                'type' => 'aarti',
                'body' => "ॐ जय शिव ओंकारा, स्वामी जय शिव ओंकारा ।\nब्रह्मा विष्णु सदाशिव, अर्द्धांगी धारा ॥ ॐ जय...\n\nएकानन चतुरानन पञ्चानन राजे ।\nहंसासन गरुड़ासन वृषवाहन साजे ॥ ॐ जय...\n\nMeaning: Glory to Lord Shiva, the cosmic creator, preserver, and destroyer. He rides the bull, Nandi, and brings peace and bliss to all who worship Him.",
            ],
            [
                'title' => 'Laxmi Aarti',
                'type' => 'aarti',
                'body' => "ॐ जय लक्ष्मी माता, मैया जय लक्ष्मी माता ।\nतुमको निसदिन ध्यावत, हर विष्णु विधाता ॥ ॐ जय...\n\nतुम पाताल निवासिनि, तुम ही शुभदाता ।\nकर्म-प्रभाव-प्रकाशिनी, भवनिधि की त्राता ॥ ॐ जय...\n\nMeaning: Salutations to Mother Laxmi, the goddess of wealth and prosperity, who is worshipped daily by all. She brings light, happiness, and success to our lives.",
            ],
            [
                'title' => 'Ambe Maa Aarti',
                'type' => 'aarti',
                'body' => "जय अम्बे गौरी, मैया जय श्यामा गौरी ।\nतुमको निसदिन ध्यावत, हरी ब्रह्मा शिवरी ॥ जय अम्बे...\n\nमांग सिन्दूर बिराजत, टीको मृगमद को ।\nउज्ज्वल से दोउ नैना, चन्द्रबदन नीको ॥ जय अम्बे...\n\nMeaning: Salutations to Durga, Mother of the Universe, who shines with divine light and protects all her children from negativity and fear.",
            ],

            // --- STORIES ---
            [
                'title' => 'Baby Krishna Story',
                'type' => 'story',
                'body' => "Little baby Krishna was very naughty. He loved eating freshly churned butter (makhan). His mother Yashoda would tie the butter pots high up, but Krishna and his friends would build human pyramids to reach the pots and eat it all! Krishna is loved by all kids as a playful friend.",
            ],
            [
                'title' => 'Lord Ganesha\'s Wisdom',
                'type' => 'story',
                'body' => "Once, Lord Ganesha and his brother Kartikeya had a race to circle the universe three times. Kartikeya flew off on his fast peacock. Ganesha, who rides a slow mouse, thought deeply. Instead of flying, he walked around his parents, Shiva and Parvati, three times. He explained, 'My parents are my universe!' Impressed by his wisdom, Lord Shiva declared Ganesha the winner.\n\nMoral: Parents are the greatest blessing and our universe.",
            ],
            [
                'title' => 'Little Hanuman and the Sun',
                'type' => 'story',
                'body' => "When Hanuman was a little baby, he saw the glowing red sun in the sky. He thought it was a ripe, delicious mango! Being born with super strength, he jumped high and flew into space to catch it. Indra, the king of gods, got worried and stopped him. Hanuman is a reminder that we all have hidden strengths inside us.\n\nMoral: Pure determination can achieve the impossible.",
            ],
            [
                'title' => 'Prahlad\'s Faith and Narasimha',
                'type' => 'story',
                'body' => "Prahlad was a little prince who loved Lord Vishnu. His father, King Hiranyakashipu, wanted everyone to worship only him. When Prahlad refused, his father tried to harm him. But Prahlad\'s deep faith kept him safe from fire and wild animals. Finally, Lord Vishnu appeared as Narasimha (half-man, half-lion) to protect Prahlad.\n\nMoral: True faith and goodness are always protected.",
            ],
            [
                'title' => 'Dhruva Tara (The Little Prince)',
                'type' => 'story',
                'body' => "Dhruva was a five-year-old prince who wanted to sit on his father's lap, but his stepmother refused. Sad but determined, Dhruva went to the forest to pray to Lord Vishnu. He sat in meditation for months. Pleased by the little boy's dedication, Lord Vishnu blessed him and turned him into the brightest star in the sky, the Pole Star (Dhruva Tara), which guides travelers.\n\nMoral: Focus, patience, and dedication lead to high achievements.",
            ],
            [
                'title' => 'Rama and the Little Squirrel',
                'type' => 'story',
                'body' => "When Lord Rama was building a bridge to Lanka, huge monkeys were carrying giant rocks. A tiny squirrel wanted to help, so it rolled in the sand and shook it off in the water between the stones. The monkeys laughed, but Lord Rama stroked the squirrel\'s back gently, creating three stripes. Rama said, \'No help is too small; what matters is the love in your heart.\'\n\nMoral: Every small effort counts when done with love.",
            ],
        ];

        foreach ($devotionalData as $idx => $item) {
            Lesson::create([
                'course_id' => $devotional->id,
                'title' => $item['title'],
                'content_type' => $item['type'],
                'body_content' => $item['body'],
                'sorting_order' => $idx,
            ]);
        }

        // D. Cultural Stories
        $cultural = Course::create([
            'title' => 'Cultural Stories',
            'slug' => 'cultural-stories',
            'description' => 'Discover Indian festivals, legends and moral values.',
            'category' => 'Stories',
            'icon' => 'book',
            'bg_color' => '#FF7D1A',
            'is_active' => true,
        ]);

        $culturalData = [
            [
                'title' => 'The Festival of Diwali',
                'body' => "Diwali is the festival of lights. It celebrates the return of Lord Rama, Sita, and Lakshmana to Ayodhya after 14 years. People light clay lamps (diyas), wear new clothes, share sweets, and draw beautiful Rangolis to welcome goodness, light, and prosperity.",
            ],
            [
                'title' => 'The Thirsty Crow',
                'body' => "A thirsty crow found a pitcher with very little water at the bottom. He could not reach it. He thought of a clever plan. He picked up small pebbles one by one and dropped them into the pitcher. Slowly, the water level rose to the top! The crow drank the water and flew away happily. \n\nMoral: Where there is a will, there is a way.",
            ],
            [
                'title' => 'The Honest Woodcutter',
                'body' => "An honest woodcutter accidentally dropped his iron axe into a river. The Goddess of River appeared and offered him a golden axe, then a silver axe. The woodcutter said, 'No, these are not mine.' Finally, she showed his iron axe, and he happily took it. Impressed by his honesty, the Goddess gifted him all three axes! \n\nMoral: Honesty is the best policy.",
            ]
        ];

        foreach ($culturalData as $idx => $story) {
            Lesson::create([
                'course_id' => $cultural->id,
                'title' => $story['title'],
                'content_type' => 'story',
                'body_content' => $story['body'],
                'sorting_order' => $idx,
            ]);
        }
    }
}
