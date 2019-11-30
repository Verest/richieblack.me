<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'ruby-php-first-impression',
                'title' => 'Ruby vs PHP - First Impression',
                'meta' => 'Richie Black\'s first impression on the differences between Ruby and PHP',
                'body' => 'I have been learning Ruby and, while there are similarities between Ruby and PHP, there are also core differences that I have run into several times.  

###Truthy and Undefined State of Variables
In PHP, I very commonly write something like...

```
if ($variable) {
\\t//do something if variable truthy 
}  
```

```$variable``` can be false, null, entirely not set, etc. and the conditional will not run. In Ruby this can just crash in some cases, notably if it was never set. Ruby will also return true if $variable is set for everything except nil and false, where as in PHP empty arrays, empty strings, etc. are all false. This will make a huge difference in how conditionals are approached in Ruby vs PHP.

###"Smart" Addition and String Concatenation
In PHP, it is perfectly valid to add an integer to a string. E.g...

```
1 + \'23\'; //gives 24 as an integer
1 . \'a23\' // gives \'1a23\' as a string
```

In Ruby, both numeric and string addition use the same operator, the ```+``` symbol. Both of the lines above would fatally crash in Ruby, casting via ```to_i``` or similar is required.

###Variable Declaration
In PHP, all variables are declared prefixed with a ```$``` sign. However there are some similarities between variable types.  

1. PHP has global variables accessed though the \'global\' prefix. Ruby has global variables prefixed directly with a ```$``` sign e.g. ```$var```.  
2. PHP has static class variables, Ruby has class variables directly prefixed with ```@@``` e.g. ```@@var```.  
3. PHP has instance variables with no special syntax, defined as an attribute of the class. Ruby syntax places a single ```@``` before the variable name e.g. ```@var```.  

###Scoping
In PHP, a nested function can see any variable declared outside it even if it isn\'t directly passed in. Ruby can NOT, although it can still see instance variables. This is a rather huge change and, while I didn\'t take advantage of it in PHP heavily, it is something that is important to be aware of.

###Pass By Value or Reference
In PHP, an ```&``` can be used to force a pass by reference - there doesn\'t seem to be a similar function in Ruby. However, Ruby seems to behave in a similar fashion to PHP in the scenario that a PHP method is accepting an Object. Both are pass by value, but the value being copied is a reference, so it CAN affect the values of the parent object being passed in. More or less, directly reassigning the value passed in will not affect the initial value e.g...

```
&#35;if var = \'foo\', var will still = \'foo\' after calling fn&#95;name.
fn&#95;name(var)
def fn&#95;name(var)
\\t var = \'bar\'
end
```

However, if modifying an attribute of the passed in object/instance, it WILL affect the initial object as it both the original object and the passed in object share the same reference. Since nearly everything in Ruby IS an object, this is very important to keep in mind.  

```
def fn&#95;name(var)
\\t var[:test] = 2
end
\\t
var = {test: 4}
fn&#95;name(var)
&#35;at this point, var[:test] will equal 2, as it was changed within fn&#95;name
```
###Strings
Ruby and PHP seem to be similar in how they behave with single vs double quoted strings. In both languages, single quotes are more or less treated literally where as double quotes allow interpolation and backslash sequences e.g. ```\\n```.

###Conclusion
There are several more differences, but the ones covered above I found to currently be the most impactful for me to keep track of. Overall Ruby seems to be more succinct in its syntax, but more strict when it comes to variable types and declarations, or the lack thereof. Since Ruby is more or less "pass by copy of object reference" for everything, it will affect how I approach problem solving.',
                'created_at' => '2019-09-15 00:00:00',
                'updated_at' => '2019-11-30 21:47:42',
            ),
        ));
        
        
    }
}