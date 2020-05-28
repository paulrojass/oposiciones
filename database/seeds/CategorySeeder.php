<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Subcategory;
use App\Tag;
use App\Question;
use App\Answer;

class CategorySeeder extends Seeder
{
    public function run()
    {
		factory(Category::class,3)->create()->each(function($category){
			factory(Subcategory::class,2)->create(['category_id' => $category->id])->each(function($subcategory){
				factory(Tag::class,3)->create(['subcategory_id' => $subcategory->id])->each(function($tag){
					factory(Question::class,5)->create()->each(function($question) use($tag){
						factory(Answer::class,1)->create(['question_id'=>$question->id, 'correct' => 1]);
						factory(Answer::class,6)->create(['question_id'=>$question->id, 'correct' => 0]);
				        DB::table('question_tags')->insert([
				            'question_id' => $question->id,
				            'tag_id' => $tag->id
				        ]);
					});
				});
			});
		});
    }
}
