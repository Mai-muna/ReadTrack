# ReadTrack
ReadTrack is a dynamic web-based platform designed for book enthusiasts. It provides a centralized system for users to discover new books, track their reading progress, manage personal libraries, set reading goals, and share reviews with a community of readers and authors.

Table of Contents:
  Key Features
  Tech Stack
  Database Schema
  Getting Started
  Prerequisites
  Installation & Setup
  Screenshots

Key Features

  👤 User Profile Management: Secure user authentication with roles (Reader, Author, Admin). Users can manage their profiles, including bios and personal information.

  📚 Book Management: Authors can submit new books for admin approval. Admins can manage the book catalog.

  🔍 Powerful Search: Users can easily search for books by title to discover new reads.

  ⭐ Rating and Review System: Readers can leave a star rating (1-5) and a written review for books they have completed.

  📖 To-Be-Read (TBR) List: Users can add books to a personal TBR list to keep track of books they want to read next.

  🎯 Annual Reading Goals: Users can set and track their progress towards an annual reading goal.

Tech Stack
  Frontend: React, HTML5, CSS3, Tailwind CSS

  Backend: Node.js, Express.js

  Database: MySQL

  Authentication: JWT (JSON Web Tokens)

Database Schema
  The database is designed using an Enhanced Entity-Relationship (EER) model to ensure data integrity and minimize redundancy.

Getting Started
  Follow these instructions to get a local copy of the project up and running for development and testing purposes.

Prerequisites
  Make sure you have the following software installed on your machine:
    Node.js (which includes npm)
    XAMPP

Installation & Setup
  1) Clone the repository:
    git clone [https://github.com/Mai-muna/ReadTrack.git]

  2) Setup the Backend:<br>
  Step 1: Paste the file in htdocs file in XAMPP
            C:\xampp\htdocs<br>
  Step 2: Start XAMPP and start it.<br>
<img width="666" height="429" alt="image" src="https://github.com/user-attachments/assets/0adcb0ef-9099-4219-a58b-ea5393de0ee5" /><br>
  Step 3: Select admin on mySQL to start phpmyadmin<br>
<img width="663" height="431" alt="image" src="https://github.com/user-attachments/assets/82511c2f-7425-489c-bff3-fde8d3d4e28f" /><br>
  Step 4: In http://localhost/phpmyadmin/ select new and create a file with the same name as the file in htdocs. Select sql and paste the queries from the ReadTrack.txt file one by one and press go.<br>
<img width="237" height="154" alt="image" src="https://github.com/user-attachments/assets/9f7abfed-1925-4234-8bc3-49aac1715739" /><br>
<img width="687" height="182" alt="image" src="https://github.com/user-attachments/assets/92b12db3-4aac-46f6-95be-8490868125a4" /><br>
<img width="611" height="136" alt="image" src="https://github.com/user-attachments/assets/87a1786a-eadd-478a-9b30-c966c8dd2601" /><br>
<img width="725" height="812" alt="image" src="https://github.com/user-attachments/assets/03d73fb9-238a-49ef-8508-985a3d8b0fcf" /><br>
  Stepp 5: go to http://localhost/readtrack/<br>
<img width="937" height="652" alt="image" src="https://github.com/user-attachments/assets/d13e90f8-6045-40a8-828c-bc26fb0a450e" /><br>

User Manual :
  1. Getting Started <br>
    Creating an Account<br><br>
      To begin using ReadTrack, you'll need to create an account.<br>
      Navigate to the ReadTrack homepage.<br>
      Click the "Sign Up" button.<br>
      Fill in the required fields: your name, a valid email address, and a secure password.<br>
      Click "Create Account". You will be automatically logged in and taken to your dashboard.<br>
    Logging In<br><br>
      If you already have an account:<br>
      Navigate to the ReadTrack homepage.<br>
      Click the "Log In" button.<br>
      Enter your registered email address and password.<br>
      Click "Log In".<br>
    
  2. Exploring ReadTrack<br>
    Searching for Books<br>
    Finding your next great read is easy.    
    Locate the Search Bar at the top of any page.
    Type the title of the book you are looking for.
    Press Enter or click the search icon.
    You will be taken to a results page displaying all matching books. Click on any book to view its details. You  can also sort the books by order and rating.
    Viewing Book Details<br>
    When you click on a book, you'll see its dedicated page, which includes
    The book's cover, title, and author.
    A detailed synopsis.
    The average user rating.
    A list of reviews from other readers in the community.
    
  3. Managing Your Reading<br>
    Adding a Book to Your TBR List<br>
    Found a book you want to read later? Add it to your "To-Be-Read" (TBR) list.
    Navigate to the book's detail page.
    Click the "Add to TBR" button. The book will instantly be added to your personal list.
    Managing Your TBR List<br>
    To see the books you've saved:
    Click on the "My TBR" link in the main navigation menu.
    Here you will see a list of all the books you plan to read. 
    To remove a book (for instance, after you've finished reading it), simply click the "Remove" button next to the book's title.
    Leaving a Review and Rating<br>
    Once you've finished a book, share your thoughts with the community!  
    Navigate to the book's detail page. 
    Scroll down to the review section.
    Select a star rating from 1 (poor) to 5 (excellent).
    (Optional) Write your thoughts in the text box provided.
    Click "Submit Review". Your review will now be visible to other users.
    Setting a Reading Goal<br>
    Challenge yourself with an annual reading goal. Go to your Dashboard. Find the "Goal" widget. Enter the number of books you aim to read this year. Click "Set Goal". Your progress will update automatically as you mark books as read (a feature tied to reviewing).
    
  4. Managing Your Profile<br>
    Personalize your account to reflect who you are.
    Select "Profile".
    On this page, You can change your name add bio and select Save.    
  5. For Authors: Adding a Book<br>
    If your account has "Author" privileges, you can contribute to our library. From the navigation menu, select "Upload Book". Fill out the form with the book's title, synopsis, and genre.Click "Submit for Approval". Your book will be reviewed by an administrator before it becomes visible on the platform.

Screenshots
  1. User Profile Page
  <img width="959" height="378" alt="image" src="https://github.com/user-attachments/assets/4cb0e0eb-c36d-48b7-a2d7-33e7816f7add" />

  2. Book Search Functionality
  <img width="613" height="180" alt="image" src="https://github.com/user-attachments/assets/ab3fb4be-8ea8-48f5-8aa6-501b60011e3a" />

  3. To-Be-Read (TBR) List
  <img width="951" height="276" alt="image" src="https://github.com/user-attachments/assets/7b3fb790-88b4-404a-8255-4071cc48f8dd" />

  
  4. Book Details and Reviews
 <img width="925" height="725" alt="image" src="https://github.com/user-attachments/assets/08da274e-0f06-4bb0-9b76-5f2aa4c8c6cf" />

  
  5. Reading Goal Tracker
 <img width="954" height="512" alt="image" src="https://github.com/user-attachments/assets/1d5b3c33-fd4a-402a-9e08-d9a2c7dae479" />

  6. Book to approve
  <img width="951" height="232" alt="image" src="https://github.com/user-attachments/assets/9058e90f-717b-48d4-af55-8ab1a55b45df" />

  7. Adding a Book
  <img width="933" height="483" alt="image" src="https://github.com/user-attachments/assets/80a7ece7-3068-4839-935a-ed65af043b4e" />
 


    




