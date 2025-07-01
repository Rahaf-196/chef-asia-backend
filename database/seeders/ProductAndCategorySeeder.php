<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;

class ProductAndCategorySeeder extends Seeder
{
    public function run(): void
    {
        // حذف البيانات القديمة بدون خرق القيود
        DB::table('products')->delete();
        DB::table('categories')->delete();

        // إنشاء التصنيفات
        $categories = [
            1 => 'Appetizers',
            2 => 'Soups',
            3 => 'Salads',
            4 => 'Rice & Noodles',
            5 => 'Main Course',
            6 => 'Sushi',
            7 => 'Desserts',
            8 => 'Drinks',
        ];

        foreach ($categories as $id => $name) {
            Category::create([
                'id' => $id,
                'name' => $name,
            ]);
        }

       
        $products = [
             [
                'name' => 'Shrimp Spring Rolls',
                'description'=> "Spring Roll Wrapper, Shrimps, White Cabbage, Carrots, Fried Red Onions, Oyster Sauce, Soya Sauce, Served With Sweet Sauce, Allergens: Gluten, Nuts, Seafood, Caviar",
                'price' => 5.00,
                'category_id' => 1,
                'image' => 'images/Appetizers1.jpeg'

            ],
            [
                'name' => 'Dynamite Shrimp',
                'description' => "Tempura Battered Shrimps Tossed In Dynamite Sauce. Note: Contains Gluten, Milk & derivatives, Egg, Mayonnaise Seafood, Nuts",
                'price' => 5.00,
                'category_id' => 1,
                'image' => 'images/Appetizers2.jpg'
            ],
            [
                'name' => "Yummy Special Fries",
                'description' => "French Fries, Tom Yum Paste. Served With Honey Mustard Sauce Or Ketchup",
                'price' => 5.00,
                'category_id' => 1,
                'image' => 'images/Appetizers3.jpg'
            ],
            [
                'name' => 'Tom Yum Soup',
                'description' => "Shrimp, Fish Sauce, Lemon Sauce, Tom Yum Paste, Thai Ginger, Lemon Leaves, Lemon Grass, Mushrooms, Tomatoes",
                'price' => 4.00,
                'category_id' => 2,
                'image' => 'images/Soup4.jpeg'
            ],
            [
                'name' => 'Mixed Seafood Soup',
                'description' => "Shrimp, Squid, Cuttlefish, White Mushrooms, Shitakee Mushrooms, Bell Peppers, White Onions, Carrots, Chinese Cabbage, White Cabbage, Broccoli, Cauliflower, Oyster Sauce, Soy Sauce, Fish Sauce. Allergens: Gluten",
                'price' => 4.00,
                'category_id' => 2,
                'image' => 'images/Soup6.jpg'
            ],
            [
                'name' => "Cream of Seafood Soup",
                'description' => "Squid, Cuttlefish, Shrimp, Cream, Bell Peppers, White Onions, Green Onions, White Mushrooms, Carrots . Allergens: Gluten",
                'price' => 4.00,
                'category_id' => 2,
                'image' => 'images/Soup5.jpg'
            ],
            [
                'name' => 'Crab Salad',
                'description' => "A mixture of lettuce, avocado, crab slices and special sauce",
                'price' => 4.50,
                'category_id' => 3,
                'image' => 'images/Salad7.jpeg'
            ],
            [
                'name' => "Chicken Chef Salad",
                'description' => "Lettuce, tomatoes, cabbage, grilled chicken pieces with cheese slices",
                'price' => 4.50,
                'category_id' => 3,
                'image' => 'images/Salad8.jpg'
            ],
            [
                'name' => "Rice With Egg",
                'description' => "Rice, Eggs, Garlic, Green Onions",
                'price' => 6.00,
                'category_id' => 4,
                'image' => 'images/Rise_Noodles1.jpeg'
            ],
            [
                'name' => "Vegetables Fried Rice",
                'description' => "Rice, White Mushrooms, Baby Corn, Bean Sprouts, Eggs, Green Peas, Carrots, Green Onions, Ginger, Garlic, Fresh Coriander. Allergens: Egg & mayonnaise",
                'price' => 6.00,
                'category_id' => 4,
                'image' => 'images/Rise_Noodles2.jpg'
            ],
            [
                'name' => 'Shrimp Fried Rice',
                'description' => "Rice, Shrimp, Eggs, Garlic, Green Peas, Carrots, Green Onions. Allergens: Egg & mayonnaise",
                'price' => 6.00,
                'category_id' => 4,
                'image' => 'images/Rise_Noodles3.jpg'
            ],
            [
                'name' => "Plain Fried Noodles",
                'description' => "Noodles, Oyster Sauce, Soy Sauce. Allergens: Gluten, Nuts",
                'price' => 6.50,
                'category_id' => 4,
                'image' => 'images/Rise_Noodles4.jpg'
            ],
            [
                'name' => "Noodles With Vegetables and Chicken",
                'description' => "Noodles, Shredded Chicken, White Onions, Bell Peppers, Carrots, White Mushrooms, Shiitake Mushroom, Chinese Cabbage, White Cabbage, Young Corn, Oyster Sauce, Soy Sauce, White Pepper, Sesame Oil. Allergens: Gluten, Nuts",
                'price' => 6.50,
                'category_id' => 4,
                'image' => 'images/Rise_Noodles5.jpg'
            ],
            [
                'name' => 'Shrimp Teppanyaki',
                'description' => "Shrimp, White Pepper, Eggs, White Onion, Tomato, Ginger, Green Onions, Ketchup, Chili Sauce, Sesame Oil. Note: Contains Gluten",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course1.jpg'
            ],
            [
                'name' => "Shrimp with Chili Sauce",
                'description' => "Shrimp, Eggs, Pepper, Tomato Paste, Ketchup, Vinegar, Chili Sauce, Ginger, Garlic, Green Onions, Slice Tomato, Slice White Onion",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course2.jpg'
            ],
            [
                'name' => "Shrimp Kindo",
                'description' => "Shrimp, Pepper, Eggs, Soy Sauce, Tonkatsu Sauce, Worchester Sauce, Ketchup, Garlic, Sesame Seeds. Note: Contains Gluten",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course3.png'
            ],
            [
                'name' => "Shrimp with Dry Chili & Garlic",
                'description' => "Shrimp, Pepper, Salt, Eggs, Zucchini, White Onion, Garlic, Green Onions, Dried Chili, Ketchup, Vinegar. Note: Contains Gluten",
                'price' => 10.50,
                'category_id' => 5,
                'image' => 'images/Main_course4.webp'
            ],
            [
                'name' => "Beef Kindo",
                'description' => "Beef, Ginger, Green Onions, Oyster Sauce, Soy Sauce. Allergens: Egg, Mayonnaise",
                'price' => 9.50,
                'category_id' => 5,
                'image' => 'images/Main_course5.jpg'
            ],
            [
                'name' => "Teriyaki Beef",
                'description' => "Beef Shredded, Green Pepper, Onion White, Teriyaki Sauce",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course6.jpg'
            ],
            [
                'name' => "Beef with Green Onions",
                'description' => "Beef, Soy Sauce, Tonkatsu Sauce, Garlic, Green Onions. Allergens: Egg, Mayonnaise",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course7.jpg'
            ],
            [
                'name' => "Chicken Teriyaki",
                'description' => "Chicken Shredded, Green Pepper, Onion White, Teriyaki Sauce",
                'price' => 8.50,
                'category_id' => 5,
                'image' => 'images/Main_course8.jpg'
            ],
            [
                'name' => 'California Maki',
                'description' => "Boiled Shrimp, Crab Sticks, Avocado, Tobiko Caviar, Japanese Mayonnaise. Allergens: Gluten, Eggs, Mayonnaise, Caviar, Avocado",
                'price' => 10.50,
                'category_id' => 6,
                'image' => 'images/Sushi1.webp'
            ],
            [
                'name' => "Caterpillar Maki",
                'description' => "Smoked Salmon, Tamago Japanese Omelette, Avocado, Cucumber, Japanese Mayonnaise, Thousand Island Sauce. Allergens: Mayonnaise & Eggs, Avocado, Nuts",
                'price' => 10.50,
                'category_id' => 6,
                'image' => 'images/Sushi2.jpg'
            ],
            [
                'name' => "Crazy Maki",
                'description' => "Boiled Shrimp, Crabsticks, Avocado, Cucumbers, Tobiko Caviar, Japanese Mayonnaise, Tongarashi Spices. Allergens: Gluten, Caviar, Avocado, Egg & Mayonnaise",
                'price' => 10.50,
                'category_id' => 6,
                'image' => 'images/Sushi3.webp'
            ],
            [
                'name' => "Futo Maki",
                'description' => "Smoked Salmon, Tamago Japanese Omelette, Crab Sticks, Avocado, Daikon Pickled Radish, Cucumbers, Japanese Mayonnaise. Allergens: Gluten, Mayonnaise, Nuts",
                'price' => 10.50,
                'category_id' => 6,
                'image' => 'images/Sushi4.jpg'
            ],
            [
                'name' => "Salmon Hosso Maki",
                'description' => "Nori Sheet, Sushi Rice, Fresh Raw Salmon, Japanese Mayonnaise. Allergens: Fish",
                'price' => 10.50,
                'category_id' => 6,
                'image' => 'images/Sushi5.jpg'
            ],
            [
                'name' => "Mixed Sushi Medium",
                'description' => "8 Pcs California, 6 Pcs Kappa Shake, 1 Pc Ebi Nigiri, 1 Pc Shake Nigiri, 1 Pc Caviar Nigiri, 2 Pcs Tamago, 2 Pcs Kani Nigiri. Allergens: Gluten",
                'price' => 30.50,
                'category_id' => 6,
                'image' => 'images/Sushi6.jpg'
            ],
            [
                'name' => "Special Mixed Sushi",
                'description' => "4 Pcs Tempura Roll, 8 Pcs Crazy Maki, 8 Pcs Caterpillar, 10 Pcs Tampa Maki, 8 Pcs Kappa Roll. Served With Pickled Ginger, Wasabi And Soy Sauce. Allergens: Gluten",
                'price' => 40.50,
                'category_id' => 6,
                'image' => 'images/Sushi7.jpeg'
            ],
            [
                'name' => 'Crème Brûlée',
                'description' => "Eggs, Cream, Milk, Vanilla. Allergens: Gluten, Milk & its Derivatives, Egg & mayonnaise",
                'price' => 5.50,
                'category_id' => 7,
                'image' => 'images/Desserts1.webp'
            ],
            [
                'name' => "Mochi",
                'description' => "Ground rice, sugar, cornstarch, and ice cream, adding the chef's special flavor",
                'price' => 5.50,
                'category_id' => 7,
                'image' => 'images/Desserts2.jpg'
            ],
            [
                'name' => 'Pepsi',
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks1.webp',
            ],
            [
                'name' => '7 Up',
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks2.webp'
            ],
            [
                'name' => "Fanta",
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks3.webp'
            ],
            [
                'name' => "Miranda Citrus",
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks4.webp'
            ],
            [
                'name' => "Miranda",
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks5.webp'
            ],
            [
                'name' => "Water",
                'price' => 1.50,
                'category_id' => 8,
                'image' => 'images/Drinks6.png'
            ],
            
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
