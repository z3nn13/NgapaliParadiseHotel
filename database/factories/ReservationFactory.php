<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = [
            'Upcoming',
            'Cancelled',
            'Cancelling',
            'Finished',
        ];
        $date1 = Carbon::now();
        $date2 = Carbon::now()->addMonth();
        $check_in = fake()->dateTimeBetween($date1, $date2);
        $user_id = rand(1, 2);
        $user = User::find($user_id);

        return [
            'user_id' => $user_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => fake()->email(),
            'phone_no' => fake()->phoneNumber(),
            'country' => fake()->country(),
            'num_guests' => fake()->numberBetween(1, 10),
            'check_in_date' => $check_in,
            'check_out_date' => Carbon::parse($check_in)->addDays(2),
            'special_request' => fake()->text(),
            'status' => $status[array_rand($status)],
        ];
    }
}
