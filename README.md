This is a projected created as a Technical inteview for Medbook Kenya Limited.

To run the application on your computer, use the below instructions:
1. Open the compressed folder and unzip the contents in the root of your local web server (the 'www' or 'htdocs' folder depending on your server setup)
2. Use a command line application to navigate to the 'medbook-dev-backend' folder
3. In your IDE of choice, open the 'medbook-dev-backend' folder and edit the '.env' file
4. Change the database credentials to match your database settings 
5. Run the command 'php artisan migrate --seed' to create the database tables and also populate the default username in the 'users' table
6. Once step 3 above is completed, use the command 'php artisan serve' to run the Laravel application on your computer
7. Open another command line application on your computer and navigate to the 'medbook-dev-frontend' folder
8. Run the command 'ng build' to create the browser components of the application
9. Once step 6 above is finished, run the command 'ng serve -o' to run the frontend application and it will automatically open your browser to the root of the application
