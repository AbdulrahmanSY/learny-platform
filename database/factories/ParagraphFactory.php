<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paragraph>
 */
class ParagraphFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lang_id = $this->faker->randomElement([1, 2]);
        $arabicSentences = array(
            'مرحبًا بك في عالم البرمجة.',
            'تعلم لغة جديدة هو تحدٍ ممتع.',
            'وإذا استثنينا الصين فلا يوجد شعب آخر يحق له الفخر بوفرة كتب علوم لغته غير العرب.',
            'التكنولوجيا تغيّر حياتنا بشكل كبير.',
            'اللغة العربية هي التي أدخلت في الغرب طريقة التعبير العلمي، والعربية من أنقى اللغات، فقد تفردت في طرق التعبير العلمي والفني.',
            'الإبداع يأتي من التجربة والممارسة.',
            'عليك دائمًا تحديد أهدافك والسعي نحوها.',
        );
        $enSentences = array(
            'What is a semicolon?
What is correct semicolon use? The most common semicolon use is joining two independent clauses without using a coordinating conjunction like and. Semicolons can also replace commas when listing items that already use commas, such as listing cities and states.

Semicolons (;) are as basic as a period stacked on top of a comma. Does that mean you can use it like either one? Don’t get your hopes up. But don’t let this punctuation mark get you down either..',
            'Hyphens with compound modifiers: Multiple-word adjectives before nouns
Using hyphens to connect words is easy. Picking the right words to connect is a little harder. Let’s start with compound modifiers, also known as phrasal adjectives.

A compound modifier is made up of two or more words that work together to function like one adjective in describing a noun. When you connect words with a hyphen, you make it clear to readers that the words work together as a unit of meaning..',
            'How Grammarly Can Help
Grammarly’s full range of writing feedback is designed to help you make your writing the best it can be. With real-time suggestions on everything from spelling, grammar, and punctuation to tone and clarity, you can be confident that your writing presents your ideas in their best light..',
            'Who are the indigenous peoples of the world?
Indigenous people are the first people to live in a particular place – the original population that first created a community on that land before other people came to live in, conquer or colonise the area. People self-identify as indigenous. That means they decide for themselves whether they consider themselves to be indigenous.

There are more than 350 million indigenous people living in 90 countries. They represent 5,000 different cultures and speak the great majority of the thousands of languages that are spoken around the world today. Indigenous communities often have distinct beliefs, culture and customs. Many indigenous people still live in very close contact with the land, with a respect for and understanding of their natural surroundings. .',
            'What challenges do they face?
Indigenous peoples are not the dominant groups in the societies they live in. The dominant groups are the people that arrived later. This means that indigenous peoples have suffered from many problems related to a lack of economic power, social protection and political representation.

Although indigenous people make up less than five per cent of the world total population, they represent 15 per cent of the world  poorest people. They are more likely to have limited access to healthcare and education, and members of indigenous communities live shorter lives than non-indigenous groups. Their languages are not normally taught in schools, and many of these languages are in danger of disappearing. It is estimated that one indigenous language is lost every two weeks.',
            "Despite the progress made, indigenous communities still legally own only a very small percentage of their land globally. The UN document is an important step, but more countries need to commit to it, and the countries that have signed need to do what they have promised. All around the world, indigenous people are fighting for their rights, as well as protesting against deforestation and climate change. Part of the movement to support them is the celebration of the International Day of the World's Indigenous Peoples on 9 August. Why not join in?.",

        );
        return [

            'paragraph' =>$lang_id === 2 ? $this->faker->randomElement($arabicSentences) : $this->faker->randomElement($enSentences),
            'teacher_id' => $this->faker->randomElement(Teacher::where('teacher_status_id',1)->pluck('id')),
            'paragraph_category_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'language_id' => $lang_id,
            'content_levels_id' => $this->faker->randomElement([1, 2, 3]),
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
