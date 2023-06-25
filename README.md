# Snappfood Clone

> A simplified clone of Snappfood built with Laravel and Tailwind.

## Features

### Admin Features

- Create categories for foods and restaurants.
- Generate discount codes.
- Manage comments and have control over their visibility.
- Access a simple dashboard to monitor restaurants and orders.

### Seller Features

- Create restaurants and define their locations and working hours.
- Create and manage food items, assigning them to respective restaurants.
- Approve or decline comments related to their restaurants.
- View basic statistics about their orders.

### User Features (Implemented via API)

- Discover nearby restaurants based on location.
- Place food orders.
- Add comments to the cart.
- Receive notifications about order status changes.


<br><br>

![image](https://github.com/hassanalidoost/snapp-food-clone/assets/46284743/d9aefdbd-c8a5-4c01-93b5-06a14b53acff)

<br><br>

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/hassanalidoost/snapp-food-clone.git

2. Navigate to the project directory:
   
   ```bash
   cd snapp-food-clone

3. Install dependencies:

    ```bash
    composer install

4. Copy the example environment file and configure the necessary details:

    ```bash
    cp .env.example .env
    
5. Generate a new application key:
     ```bash
     php artisan key:generate
6. Create a database and update the .env file with the database details.
7. Run the database migrations:
    ```bash
    php artisan migrate
8. Visit http://localhost:8000 in your web browser to access the Snappfood clone.
   
