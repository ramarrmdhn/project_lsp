# Concert Ticket Sales System

A complete web-based concert ticket sales system built with CodeIgniter 3, PHP, and MySQL.

## Features

### User Features
- **User Registration & Authentication**
  - User registration with email verification
  - Login/logout functionality
  - Password reset via email
  - Profile management

- **Concert Browsing**
  - View all available concerts
  - Search concerts by keyword, artist, venue, or date
  - Filter concerts by category (upcoming, popular, etc.)
  - View concert details and available tickets

- **Shopping Cart**
  - Add tickets to cart
  - Update quantities
  - Remove items
  - View cart summary
  - Cart validation

- **Order Management**
  - Complete checkout process
  - Order history
  - Order status tracking
  - Download tickets (PDF)
  - Cancel orders (if allowed)

- **User Profile**
  - View and edit profile information
  - Change password
  - View order history
  - Account management

### Admin Features
- **Dashboard**
  - Overview statistics
  - Recent orders
  - Popular concerts
  - System status

- **Concert Management**
  - Add, edit, delete concerts
  - Manage concert status
  - Add/edit tickets for concerts
  - View concert details

- **User Management**
  - View all users
  - Add, edit, delete users
  - Block/unblock users
  - Reset user passwords
  - Search and filter users

- **Order Management**
  - View all orders
  - Update order status
  - Cancel orders
  - Export orders to CSV
  - Print orders
  - Send confirmation emails

- **Reports & Analytics**
  - Sales reports
  - User statistics
  - Popular concerts
  - Revenue analytics
  - Date range filtering

- **System Management**
  - Database backup
  - System logs
  - Settings management
  - Data export

## System Architecture

### Models
- `User_model` - User management
- `Concert_model` - Concert management
- `Ticket_model` - Ticket management
- `Order_model` - Order management
- `Order_item_model` - Order items
- `Cart_model` - Shopping cart

### Controllers
- `Home` - Homepage and general pages
- `Auth` - Authentication (login, register, password reset)
- `Concert` - Concert browsing and details
- `Cart` - Shopping cart functionality
- `Order` - Order management
- `Profile` - User profile management
- `Admin` - Admin dashboard and general admin functions
- `Admin_concert` - Concert management in admin panel
- `Admin_user` - User management in admin panel
- `Admin_order` - Order management in admin panel
- `Migration` - Database migration

### Database Tables
- `users` - User accounts
- `concerts` - Concert information
- `tickets` - Ticket categories and pricing
- `orders` - Order information
- `order_items` - Individual items in orders
- `cart` - Shopping cart items

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- CodeIgniter 3.x

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd concert-ticket-system
   ```

2. **Configure database**
   - Create a MySQL database
   - Update `application/config/database.php` with your database credentials

3. **Run database migration**
   - Access `http://your-domain/migrate` to create all tables
   - This will also create a default admin user (admin@ticketconcert.com / admin123)

4. **Configure application**
   - Update `application/config/config.php` with your base URL
   - Set appropriate permissions for cache and logs directories

5. **Set up email configuration** (optional)
   - Configure email settings in `application/config/email.php`
   - Required for password reset and order confirmations

## Usage

### Default Admin Account
- **Email**: admin@ticketconcert.com
- **Password**: admin123

### User Registration
1. Visit the homepage
2. Click "Register" to create a new account
3. Fill in the registration form
4. Login with your credentials

### Admin Panel
1. Login with admin credentials
2. Access admin panel at `/admin`
3. Manage concerts, users, and orders

## API Endpoints

### Authentication
- `POST /api/check-email` - Check if email exists
- `POST /api/check-username` - Check if username exists

### Cart
- `POST /api/cart/add` - Add item to cart
- `POST /api/cart/update` - Update cart item
- `POST /api/cart/remove` - Remove item from cart
- `GET /api/cart/summary` - Get cart summary
- `GET /api/cart/validate` - Validate cart items

### Concerts
- `GET /api/concert/tickets/{id}` - Get tickets for concert
- `GET /api/concert/ticket/{id}` - Get ticket details

### Orders
- `GET /api/order/status/{id}` - Get order status

## File Structure

```
application/
├── config/
│   ├── database.php
│   ├── routes.php
│   └── config.php
├── controllers/
│   ├── Home.php
│   ├── Auth.php
│   ├── Concert.php
│   ├── Cart.php
│   ├── Order.php
│   ├── Profile.php
│   ├── Admin.php
│   ├── Admin_concert.php
│   ├── Admin_user.php
│   ├── Admin_order.php
│   └── Migration.php
├── models/
│   ├── User_model.php
│   ├── Concert_model.php
│   ├── Ticket_model.php
│   ├── Order_model.php
│   ├── Order_item_model.php
│   └── Cart_model.php
├── views/
│   ├── templates/
│   ├── home/
│   ├── auth/
│   ├── concerts/
│   ├── cart/
│   ├── orders/
│   ├── profile/
│   └── admin/
└── libraries/
    └── DatabaseMigration.php
```

## Security Features

- Password hashing using PHP's `password_hash()`
- Session management
- CSRF protection
- Input validation and sanitization
- SQL injection prevention
- XSS protection

## Customization

### Adding New Features
1. Create new models in `application/models/`
2. Create new controllers in `application/controllers/`
3. Create new views in `application/views/`
4. Update routes in `application/config/routes.php`

### Styling
- The system uses Bootstrap 5 for responsive design
- Custom CSS can be added to `assets/css/`
- JavaScript files are in `assets/js/`

### Database Schema
- All tables include `created_at` and `updated_at` timestamps
- Foreign key constraints are properly defined
- Indexes are created for better performance

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `application/config/database.php`
   - Ensure MySQL service is running

2. **Migration Fails**
   - Check database permissions
   - Ensure all required tables don't already exist

3. **Session Issues**
   - Check session configuration in `application/config/config.php`
   - Ensure session directory is writable

4. **Email Not Working**
   - Configure email settings in `application/config/email.php`
   - Check SMTP credentials

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## Changelog

### Version 1.0.0
- Initial release
- Complete user and admin functionality
- Database migration system
- Responsive design
- Security features implemented 