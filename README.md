Auction App
===========================

Overview
--------

This project is an **Auction App** built with **Laravel** and **Blade**. It enables users to manage products, submit price offers, and allows sellers to view and manage their products efficiently.

Key Features
------------

*   **User Authentication**: Secure sign-in and sign-up functionality using Laravel Breeze.
*   **Product Management**: Sellers can create, view, and delete their products.
*   **Price Offers**: Users can submit offers on products, with restrictions to ensure only one offer per user per product.
*   **Bid Management**: Sellers can view offers submitted for their products and delete their products as needed.
*   **Search Functionality**: Users can search for products by name and filter by seller name.

Technologies Used
-----------------

*   **Backend**: [Laravel 11.x](https://laravel.com/)
*   **Frontend**: [Blade templating engine](https://laravel.com/docs/11.x/blade) for rendering views.
*   **Database**: MySQL (or any supported database)
*   **CSS Framework**: [Bootstrap](https://getbootstrap.com/) for styling

Installation and Setup
----------------------

### Prerequisites

*   PHP 8.x and Composer
*   MySQL or any supported database

### Step-by-Step Instructions

1. Clone the Repository
```
   git clone https://github.com/ShamsAlhajjaj/auction-app.git

   cd auction-app
```

2. Install PHP Dependencies
```
   composer install
```

3. Set Up Environment Variables
   Copy the `.env.example` file to `.env`
```
   cp .env.example .env
```
   Update your .env file with your database credentials.

4. Generate Application Key
```
   php artisan key:generate
```

5. Run Migrations
```
   php artisan migrate
```

6. Link Storage for Image Uploads
```
   php artisan storage:link
```

7. Start the Development Server
```
   php artisan serve
```

8. Compile Frontend Assets
```
   npm install

   npm run dev
```
Routes Overview
---------------

*   `GET /products`: Displays all products.
*   `GET /products/create`: Shows the form to create a new product.
*   `POST /products/store`: Handles the submission of the new product.
*   `GET /products/{productId}`: Displays details of a specific product.
*   `GET /myProducts`: Displays products owned by the authenticated user.
*   `POST /bids/store`: Submits a price offer for a product.
*   `DELETE /bids/{id}`: Deletes a specific offer submitted by the user.
*   `DELETE /products/{id}`: Deletes a specific product owned by the user.

Project Structure
-----------------

*   `app/`: Contains the application logic including controllers and models.
*   `resources/views/`: Contains the Blade templates for the frontend.
*   `public/`: Contains the publicly accessible files, including images.


Future Enhancements
-------------------

*   **Role-Based Access Control**: Implement more refined user roles and permissions.
*   **Testing**: Add unit tests and feature tests to ensure reliability.
*   **Performance Optimization**: Consider caching mechanisms for improved performance.

Contributing
------------

Contributions are welcome! Feel free to submit a pull request or open an issue for any suggestions or improvements.

License
-------

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
