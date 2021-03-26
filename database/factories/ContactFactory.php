<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $person_id = $this->faker->numberBetween(1, 100);

        $type = $this->faker->randomElement(['email', 'facebook', 'telephone', 'celphone']);
        
        switch($type){
            case 'email':
                $contact = $this->faker->email;
                break;
            case 'facebook':
                $contact = 'facebook.com/' . $this->faker->username;
                break;
            case 'telephone':
                $contact = $this->faker->e164PhoneNumber;
                break;
            case 'celphone':
                $contact = $this->faker->e164PhoneNumber;
                break;
        }

        return [
            'person_id' => $person_id,
            'type' => $type,
            'contact' => $contact
        ];
    }
}
