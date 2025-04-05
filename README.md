# 🌾 E-commerce Agriculture Website - LandCo

This is a fully functional E-commerce website for agriculture-related products, developed using **HTML**, **CSS**, **JavaScript**, and **PHP**. It allows users to browse, search, and purchase agricultural goods like seeds, fertilizers, equipment, and more.

## 🚀 Features

- 🛒 Add to Cart and Checkout System
- 👤 User Registration & Login (Authentication)
- 🔍 Product Search and Filtering
- 📦 Admin Panel for Product Management (Add/Edit/Delete)
- 💬 Contact Form / Customer Inquiry
- 📄 Order Summary and Confirmation
- 🌐 Responsive Design (Mobile & Desktop Friendly)

## 🛠️ Technologies Used

| Technology | Purpose |
|------------|---------|
| HTML       | Structure of the webpages |
| CSS        | Styling and layout |
| JavaScript | Client-side interactivity |
| PHP        | Server-side logic, database handling |
| MySQL      | Database to store product, user, and order info |


## 💾 Database

- **Database Name**: `shop_db`
- Tables:
  - `users` – for storing user data
  - `products` – for product listings
  - `orders` – for order information
  - `cart` – for managing cart items
  - `messages` – for contact form data
  - `admins` – for storing admin data
  - `categories` – for storing categories data
  - `subcategories` – for storing subcategories data
  - `wishlist` – for storing wishlist data

> 📌 Import the SQL file (`shop_db.sql`) into your database before running the website.

## 🔧 Setup Instructions

1. Clone or download this repository.
2. Import the database (`shop_db.sql`) using phpMyAdmin or any MySQL client.
3. Configure your `components/connect.php` file with your database credentials.
4. Host the project in your local server (XAMPP / WAMP / LAMP).
5. Open `http://localhost/LandCoAgricultureEcommerce-Web-main/` in your browser.

## 🔐 Admin Login

- **URL**: `/admin/dashboard.php`
- **Username**: `admin`
- **Password**: `111`  


![localhost_LandCoAgricultureEcomm](https://github.com/user-attachments/assets/59786eda-a4c5-44d3-ac71-f8bb219c46b6)


