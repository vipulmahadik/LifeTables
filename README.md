Welcome to LifeTables Project!
===================


Hey! I'm Vipulkumar Mahadik. A graduate student in University of Texas at Arlington.
This is my Data Mining in Healthcare Project. The concept which I have implemented in this application is ***Generation of LifeTables***. 

----------


Demo
-------------

I have hosted the demo on my official website. You can browse through the implementation of [Lifetables Project](http://vipulkumarmahadik.co.nf/lifetables)

> **Note:**

> - This project performs Survival Analysis on the Diagnosis Code provided by the end user..
> - The raw data used was provided by our University professor..
> - Analysis on the basis of Age and Sex is provided..

Walk through
-------------
#### <i class="icon-home"></i> Home Page

![This is our homepage](https://cloud.githubusercontent.com/assets/9349690/18964049/e9676f3a-863c-11e6-840b-027b0f9817a9.PNG)
You can see 2 tabs in the menu. 2nd tab server the main data.

#### <i class="icon-signal"></i> Graph Data

![Graph Data](https://cloud.githubusercontent.com/assets/9349690/18964050/e967d042-863c-11e6-8059-a561e7e6d4dd.PNG).

#### <i class="icon-tag"></i> Single Diagnosis Analysis

![Single diagram page](https://cloud.githubusercontent.com/assets/9349690/18964051/e969b966-863c-11e6-8349-1b2e99dc3290.PNG)
Here you can see analysis on single diagnosis code on the basis of age and sex. To see working:

 **1.** Enter the diagnosis code in the blank provided and chose one from
    below. 
 **2.** The data will be shown on the page loaded through AJAX call.
 **3.** Scroll down to click on get graph button which will create a graph
    and scroll to top.



#### <i class="icon-tags"></i> Comparison on 2 Diagnosis Code 

![enter image description here](https://cloud.githubusercontent.com/assets/9349690/18964052/e96d01a2-863c-11e6-91ba-ffec957a9f32.PNG)
In the Graph page go on to the second tab named as 2 Diagnosis. Enter 2 diagnosis code and see the results.
Scroll down and click on get graph button to see live comparison between 2 diagnosis codes.



----------


Building Blocks
-------------------

 1. The full project was done in HTML5, CSS3, JavaScript, jQuery and AJAX at frontend.
 2. PHP as Scripting Language.
 3. MySQL as the database and Apache as the Server.



> **Note:**

> - Create database '6339'
> - Import 'patientsnew' .sql file in the newly created database.
> - Edit retrieve.php file and enter the details.
> - "mysqli_connect('*hostname*','*username*','*password*','6339')".
> - Copy the 'ProjectNo2' folder into the www folder of localhost.
> - Start wampserver.
> - Go to link localhost/ProjectNo2/index.php