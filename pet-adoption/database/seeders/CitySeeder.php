<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->insert([
            // 1. Andhra Pradesh
            ['state_id' => 1, 'name' => 'Visakhapatnam'],
            ['state_id' => 1, 'name' => 'Vijayawada'],
            ['state_id' => 1, 'name' => 'Guntur'],
            ['state_id' => 1, 'name' => 'Nellore'],
            ['state_id' => 1, 'name' => 'Kurnool'],

            // 2. Arunachal Pradesh
            ['state_id' => 2, 'name' => 'Itanagar'],
            ['state_id' => 2, 'name' => 'Tawang'],
            ['state_id' => 2, 'name' => 'Ziro'],

            // 3. Assam
            ['state_id' => 3, 'name' => 'Guwahati'],
            ['state_id' => 3, 'name' => 'Silchar'],
            ['state_id' => 3, 'name' => 'Dibrugarh'],
            ['state_id' => 3, 'name' => 'Jorhat'],

            // 4. Bihar
            ['state_id' => 4, 'name' => 'Patna'],
            ['state_id' => 4, 'name' => 'Gaya'],
            ['state_id' => 4, 'name' => 'Bhagalpur'],
            ['state_id' => 4, 'name' => 'Muzaffarpur'],

            // 5. Chhattisgarh
            ['state_id' => 5, 'name' => 'Raipur'],
            ['state_id' => 5, 'name' => 'Bilaspur'],
            ['state_id' => 5, 'name' => 'Durg'],
            ['state_id' => 5, 'name' => 'Korba'],

            // 6. Goa
            ['state_id' => 6, 'name' => 'Panaji'],
            ['state_id' => 6, 'name' => 'Margao'],
            ['state_id' => 6, 'name' => 'Vasco da Gama'],

            // 7. Gujarat
            ['state_id' => 7, 'name' => 'Ahmedabad'],
            ['state_id' => 7, 'name' => 'Surat'],
            ['state_id' => 7, 'name' => 'Vadodara'],
            ['state_id' => 7, 'name' => 'Rajkot'],
            ['state_id' => 7, 'name' => 'Gandhinagar'],

            // 8. Haryana
            ['state_id' => 8, 'name' => 'Gurgaon'],
            ['state_id' => 8, 'name' => 'Faridabad'],
            ['state_id' => 8, 'name' => 'Panipat'],
            ['state_id' => 8, 'name' => 'Ambala'],

            // 9. Himachal Pradesh
            ['state_id' => 9, 'name' => 'Shimla'],
            ['state_id' => 9, 'name' => 'Dharamshala'],
            ['state_id' => 9, 'name' => 'Mandi'],
            ['state_id' => 9, 'name' => 'Solan'],

            // 10. Jharkhand
            ['state_id' => 10, 'name' => 'Ranchi'],
            ['state_id' => 10, 'name' => 'Jamshedpur'],
            ['state_id' => 10, 'name' => 'Dhanbad'],
            ['state_id' => 10, 'name' => 'Bokaro'],

            // 11. Karnataka
            ['state_id' => 11, 'name' => 'Bengaluru'],
            ['state_id' => 11, 'name' => 'Mysuru'],
            ['state_id' => 11, 'name' => 'Mangaluru'],
            ['state_id' => 11, 'name' => 'Hubli'],
            ['state_id' => 11, 'name' => 'Belagavi'],

            // 12. Kerala
            ['state_id' => 12, 'name' => 'Thiruvananthapuram'],
            ['state_id' => 12, 'name' => 'Kochi'],
            ['state_id' => 12, 'name' => 'Kozhikode'],
            ['state_id' => 12, 'name' => 'Thrissur'],

            // 13. Madhya Pradesh
            ['state_id' => 13, 'name' => 'Bhopal'],
            ['state_id' => 13, 'name' => 'Indore'],
            ['state_id' => 13, 'name' => 'Gwalior'],
            ['state_id' => 13, 'name' => 'Jabalpur'],

            // 14. Maharashtra
            ['state_id' => 14, 'name' => 'Mumbai'],
            ['state_id' => 14, 'name' => 'Pune'],
            ['state_id' => 14, 'name' => 'Nagpur'],
            ['state_id' => 14, 'name' => 'Nashik'],

            // 15. Manipur
            ['state_id' => 15, 'name' => 'Imphal'],
            ['state_id' => 15, 'name' => 'Thoubal'],

            // 16. Meghalaya
            ['state_id' => 16, 'name' => 'Shillong'],
            ['state_id' => 16, 'name' => 'Tura'],

            // 17. Mizoram
            ['state_id' => 17, 'name' => 'Aizawl'],
            ['state_id' => 17, 'name' => 'Lunglei'],

            // 18. Nagaland
            ['state_id' => 18, 'name' => 'Kohima'],
            ['state_id' => 18, 'name' => 'Dimapur'],

            // 19. Odisha
            ['state_id' => 19, 'name' => 'Bhubaneswar'],
            ['state_id' => 19, 'name' => 'Cuttack'],
            ['state_id' => 19, 'name' => 'Rourkela'],
            ['state_id' => 19, 'name' => 'Berhampur'],

            // 20. Punjab
            ['state_id' => 20, 'name' => 'Ludhiana'],
            ['state_id' => 20, 'name' => 'Amritsar'],
            ['state_id' => 20, 'name' => 'Jalandhar'],
            ['state_id' => 20, 'name' => 'Patiala'],

            // 21. Rajasthan
            ['state_id' => 21, 'name' => 'Jaipur'],
            ['state_id' => 21, 'name' => 'Jodhpur'],
            ['state_id' => 21, 'name' => 'Udaipur'],
            ['state_id' => 21, 'name' => 'Ajmer'],

            // 22. Sikkim
            ['state_id' => 22, 'name' => 'Gangtok'],
            ['state_id' => 22, 'name' => 'Namchi'],

            // 23. Tamil Nadu
            ['state_id' => 23, 'name' => 'Chennai'],
            ['state_id' => 23, 'name' => 'Coimbatore'],
            ['state_id' => 23, 'name' => 'Madurai'],
            ['state_id' => 23, 'name' => 'Tiruchirappalli'],

            // 24. Telangana
            ['state_id' => 24, 'name' => 'Hyderabad'],
            ['state_id' => 24, 'name' => 'Warangal'],
            ['state_id' => 24, 'name' => 'Nizamabad'],

            // 25. Tripura
            ['state_id' => 25, 'name' => 'Agartala'],
            ['state_id' => 25, 'name' => 'Udaipur'],

            // 26. Uttar Pradesh
            ['state_id' => 26, 'name' => 'Lucknow'],
            ['state_id' => 26, 'name' => 'Kanpur'],
            ['state_id' => 26, 'name' => 'Varanasi'],
            ['state_id' => 26, 'name' => 'Agra'],
            ['state_id' => 26, 'name' => 'Noida'],

            // 27. Uttarakhand
            ['state_id' => 27, 'name' => 'Dehradun'],
            ['state_id' => 27, 'name' => 'Haridwar'],
            ['state_id' => 27, 'name' => 'Nainital'],

            // 28. West Bengal
            ['state_id' => 28, 'name' => 'Kolkata'],
            ['state_id' => 28, 'name' => 'Howrah'],
            ['state_id' => 28, 'name' => 'Durgapur'],
            ['state_id' => 28, 'name' => 'Asansol'],
        ]);
    }
}
