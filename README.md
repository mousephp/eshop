## Eshop
Trang thương mại điện tử

## Tech Specification

- Laravel 7
- Admin Lte + Bootstrap 4 + Font Awesome 5
- Laravel Shoppingcart
- Vietnam maps
- Laravel filemanager

## Features

====== FRONT-END =======

- Responsive Layout
- Shopping Cart, Wishlist, Product Reviews
- Coupons & Discounts
- Product attributes: cost price, promotion price, stock, size...
- Blog: category, tag, content, web page 
- Module/Extension: Shipping, payment, discount, ...
- Upload manager: banner, images,..
- SEO support: customer URL
- Newsletter management
- Contact forms with the real-time notification (Laravel Pusher)
- Related Products, Recommendations for you in our categories
- A Product search form
- Laravel Socialite implement(Facebook, Google & twitter) & Customer login
- Product Share and follow from different social platform...
- Payment integration(Paypal)
- Order Tracking system
- Multi-level comment system
many more......

======= ADMIN =======

- Multi Auth 
- Admin roles, permission
- Product manager
- Media manager using unisharp laravel file manager
- Banner manager
- Order management
- Category management
- Brand management
- Shipping Management
- Review Management
- Blog, Category & Tag manager
- User Management
- Coupon Management
- ...
- System config: email setting, info shop, maintain status,...
- Line Chart & Pie chart ...
- Generate order in pdf form...
- Real time message & notification
- Profile Settings
Many more....


======= USER DASHBOARD =======

- Order management
- Review Management
- Comment Management
- Profile Settings


## Screenshots

![screencapture-e-shop-loc-2020-08-14-18_19_46](https://user-images.githubusercontent.com/29488275/90719631-a1940d00-e2d4-11ea-89a3-eb36960d687d.png)

![screencapture-e-shop-loc-blog-2020-08-14-18_36_21](https://user-images.githubusercontent.com/29488275/90719648-a8228480-e2d4-11ea-9c57-5ed7aef50e26.png)

![screencapture-e-shop-loc-blog-detail-where-can-i-get-some-2020-08-14-18_43_01](https://user-images.githubusercontent.com/29488275/90719658-ace73880-e2d4-11ea-9cb2-13f2b3b0c4d2.png)

![screencapture-e-shop-loc-product-track-2020-08-14-18_51_07](https://user-images.githubusercontent.com/29488275/90719682-bbcdeb00-e2d4-11ea-8e4e-7d6bfab1c421.png)

## Set up 

1. Clone the repo and cd into it
2. composer install
3. Rename or copy .env.example file to .env
4. php artisan key:generate
5. Set your database credentials in your .env file
6. run command[laravel file manager]:-  php artisan storage:link
7. Setup Email in .env
- MAIL_MAILER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_USERNAME=your_email@gmail.com
- MAIL_PASSWORD=your_password
- MAIL_ENCRYPTION=tls
- MAIL_FROM_ADDRESS=your_email@gmail.com
- MAIL_FROM_NAME="${APP_NAME}"

8. php artisan serve or use virtual host
9. Visit /admin if you want to access the admin panel. 
- Admin Email/Password: admin@gmail.com/12345678. 
- User Email/Password: user@gmail.com/123456

<p style="text-align:center">Thank You so much for your time !!!</p>


## License

[MIT license](https://opensource.org/licenses/MIT).
