<?php


namespace Database\Factories;
use App\Models\setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class settingFactory extends Factory
{
    protected $model= setting::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'facebookUrl' => $this->faker->url,
            'twiettr' => $this->faker->url,
            'linkedin' =>$this->faker->url,
            'insta'=>$this->faker->url,
            'youtube' => $this->faker->url,
            'google' => $this->faker->url,
            'WHATWEDO' => $this->faker->text(),
            'OURMISSION' => $this->faker->text(),
            'WHYCHOOSEUS' => $this->faker->text(),
            'ProductsandServices' => $this->faker->text(),
            'no1' => $this->faker->randomDigit,
            'text1' => $this->faker->word,
            'no2' => $this->faker->randomDigit,
            'text2' => $this->faker->word,
            'no3' => $this->faker->randomDigit,
            'text3' => $this->faker->word,
            'no4' => $this->faker->randomDigit,
            'text4' => $this->faker->word,
            'email' => $this->faker->email,
            'tele' => $this->faker->email,
        ];
    }
}
