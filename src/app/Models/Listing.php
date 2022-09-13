<?php
    namespace App\Models;

    class Listing {
        public static function all() {
            return [
                'heading' => 'LatestListings',
                'listings' => [
                    [
                        'id'=> 1,
                        'title'=> 'Listing One',
                        'description'=> "Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, 
                        sunt in culpa qui officia deserunt mollit anim id est laborum.",
                    ],
                    [
                        'id'=> 2,
                        'title'=> 'Listing Two',
                        'description'=> "Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, 
                        sunt in culpa qui officia deserunt mollit anim id est laborum.",
                    ]

                ]
            ]; 
        }
        public static function find($id) {
            $listings = self::all();
            foreach($listings as $listing) {
                if($listing['id'] == $id) {
                    return $listing;
                }
            }
        }
    }
