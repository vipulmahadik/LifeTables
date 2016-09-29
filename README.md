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

![This is our homepage](images/homepage.png)
You can see 2 tabs in the menu. 2nd tab server the main data.

#### <i class="icon-signal"></i> Graph Data

![Graph Data](images/graphpage.png).

#### <i class="icon-tag"></i> Single Diagnosis Analysis

![Single diagram page](images/singlediag.png)
Here you can see analysis on single diagnosis code on the basis of age and sex. To see working:

 **1.** Enter the diagnosis code in the blank provided and chose one from
    below. 
 **2.** The data will be shown on the page loaded through AJAX call.
 **3.** Scroll down to click on get graph button which will create a graph
    and scroll to top.



#### <i class="icon-tags"></i> Comparison on 2 Diagnosis Code 

![enter image description here](images/2diag.png)
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