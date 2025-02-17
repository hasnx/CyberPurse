
### **Cyberpunk 🌌 (Futuristic & Neon)**

----------

## **Rules:**

-   **Use Laravel for the backend**
    
    -   Leverage  **Eloquent ORM**  for database management (PostgreSQL) to efficiently manage user data, marketplace transactions, etc.
    -   Route and controller setup should be organized and follow best practices for RESTful routes and services.
    -   Handle requests asynchronously where appropriate to optimize performance, particularly when dealing with file uploads to  **Cloudflare R2**.
    -   Implement security measures in the backend, such as input validation, rate limiting, and CSRF protection, for a secure user experience.
-   **Use Vue.js for the frontend**
    
    -   Structure Vue components logically, with reusable and modular components.
    -   Use  **Vue 3's Composition API**  (such as  `ref`,  `reactive`, and custom hooks) to manage state and side-effects effectively.
    -   Make sure all frontend elements scale responsively for different screen sizes while retaining the Cyberpunk aesthetic.
-   **Use Tailwind CSS for styling**
    
    -   Ensure consistency in applying Tailwind's utility classes for a responsive, clean layout.
    -   Use  **custom utilities**  and extend Tailwind when necessary for custom neon effects, gradients, and animations.
    -   Keep the design system aligned with the color palette, ensuring background, text, and neon accents follow the theme.
-   **Use Inertia.js for the backend**
    
    -   Integrate  **Inertia.js**  with the Vue frontend to create a  **seamless, SPA-like experience**  without the need for traditional API routes.
    -   Backend and frontend communication should be managed through  **Inertia controllers**  to maintain a unified structure and avoid API overcomplication.
    -   Ensure  **page transitions**  are smooth by utilizing Inertia's built-in features for managing routes and state.

----------

## **1. Color Palette:**

-   **Primary Background:**
    - Deep Space: `#0D0D1F`
    - Night City: `#121212`
    - Tech Noir: `#1A1A2E`
    - Matrix Black: `#000913`

-   **Secondary Background:**
    - Neon Pink: `#9B0A3A`
    - Cyber Purple: `#3E0064`
    - Electric Blue: `#0A1A3B`
    - Hacker Green: `#002B20`

-   **Neon Accents:**
    -   **Primary Neon:**
        -   Plasma Pink: `#FF0D6A`
        -   Cyber Cyan: `#00FFFF`
        -   Matrix Green: `#00FF00`
        -   Quantum Purple: `#BD00FF`
    -   **Secondary Neon:**
        -   Synthetic Pink: `#FF5E6D`, `#FF9C9C`
        -   Digital Blue: `#33A5C9`, `#66E8FF`
        -   Binary Green: `#00FFB3`, `#33FF99`
        -   Virtual Purple: `#D533FF`, `#E066FF`

-   **Gradient Combinations:**
    ```css
    /* Cyberpunk Sunrise */
    background: linear-gradient(135deg, #FF0D6A 0%, #FF4D4D 100%);

    /* Digital Ocean */
    background: linear-gradient(135deg, #00FFFF 0%, #0066FF 100%);

    /* Matrix Rain */
    background: linear-gradient(135deg, #00FF00 0%, #003300 100%);

    /* Neon Nightlife */
    background: linear-gradient(180deg, #121212 0%, #1A1A2E 50%, #0D0D1F 100%);
    ```

----------

## **2. Background:**

-   **Primary dark blues and blacks**  as the main background for a high-tech, sleek appearance.
-   Add  **gradients**  with neon pinks, purples, or blues for a glowing, dystopian feel.
-   Consider integrating  **cyberpunk elements**, such as neon signs, circuit board patterns, or futuristic cityscapes.

----------

## **3. UI Elements:**

-   **Borders & Corners:**
    ```css
    /* Neon Border with Glow */
    .cyber-border {
        border: 1px solid rgba(255, 13, 106, 0.8);
        border-radius: 8px;
        box-shadow: 
            0 0 10px rgba(255, 13, 106, 0.5),
            inset 0 0 10px rgba(255, 13, 106, 0.2);
    }

    /* Glitch Border Effect */
    .glitch-border {
        position: relative;
        border: 2px solid #00FFFF;
        &::before {
            content: '';
            position: absolute;
            top: -2px; right: -2px; bottom: -2px; left: -2px;
            border: 2px solid #FF0D6A;
            animation: glitch 1s infinite;
        }
    }
    ```

-   **Buttons & Interactive Elements:**
    ```css
    /* Cyberpunk Button */
    .cyber-button {
        background: #121212;
        border: 1px solid #FF0D6A;
        color: #FF0D6A;
        padding: 0.75rem 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;

        &:hover {
            background: #FF0D6A;
            color: #121212;
            box-shadow: 0 0 20px #FF0D6A;
        }

        &::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 13, 106, 0.3), transparent);
            top: 0;
            left: -100%;
            transition: 0.5s;
        }

        &:hover::before {
            left: 100%;
        }
    }
    ```

----------

## **4. Typography:**

-   Use a  **techno**  or  **digital**  font (e.g.,  `Roboto Mono`,  `Audiowide`,  `Orbitron`).
-   **Primary Text:**  Light neon shades (`#E0F7FF`) or white (`#FFFFFF`).
-   **Secondary Text:**  Light gray (`#D4D4D4`) for subtle differentiation.
-   **Accent Text:**  Neon colors for highlights and emphasis.
-   Ensure  **font sizes**  are clear and readable for headings (`24px`,  `32px`,  `40px`) and body text (`16px`,  `18px`).

----------

## **5. Icons and Graphics:**

-   **Simple, geometric icons**  with glowing neon effects.
-   **Consistent stroke width**  and uniform style across all icons.

----------

## **6. Animations and Transitions:**

-   **Advanced Animations:**
    ```css
    /* Neon Pulse */
    @keyframes neonPulse {
        0% { box-shadow: 0 0 10px rgba(255, 13, 106, 0.5); }
        50% { box-shadow: 0 0 20px rgba(255, 13, 106, 0.8); }
        100% { box-shadow: 0 0 10px rgba(255, 13, 106, 0.5); }
    }

    /* Glitch Effect */
    @keyframes glitch {
        0% { clip-path: inset(50% 0 30% 0); }
        20% { clip-path: inset(20% 0 60% 0); }
        40% { clip-path: inset(40% 0 40% 0); }
        60% { clip-path: inset(80% 0 5% 0); }
        80% { clip-path: inset(10% 0 85% 0); }
        100% { clip-path: inset(40% 0 50% 0); }
    }

    /* Scanner Line */
    @keyframes scanline {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(100%); }
    }
    ```

-   **Loading States:**
    ```css
    .cyber-loading {
        position: relative;
        &::after {
            content: '';
            position: absolute;
            top: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #FF0D6A, #00FFFF);
            animation: scanline 2s linear infinite;
        }
    }
    ```

----------

## **7. Layout:**

-   Ensure  **negative space**  for a minimalist look.
-   Use a  **grid system**  for proper alignment and consistent spacing.

----------

## **8. Interactive Elements:**

-   **Buttons:**  Neon glowing text with hover effects.
-   **Input Fields:**  Dark background with neon border, glowing intensifies on focus.
-   **Toggles/Switches:**  Use neon colors for active states.

----------

## **9. Scrollbars:**

-   Thin design with neon accent color.
-   Dark background to align with the overall theme.

----------

## **10. Accessibility:**

-   Ensure sufficient contrast between  **text**  and background for readability.
-   **Use larger font sizes**  where possible for better legibility.
-   Implement  **focus states**  to ensure keyboard navigation clarity.

----------

## **11. Additional Effects (use sparingly):**

-   **Glass Morphism:**
    ```css
    .cyber-glass {
        background: rgba(255, 13, 106, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
    }
    ```

-   **Text Glitch:**
    ```css
    .cyber-text {
        position: relative;
        text-shadow: 
            0.05em 0 0 rgba(255, 0, 0, 0.75),
            -0.025em -0.05em 0 rgba(0, 255, 0, 0.75),
            0.025em 0.05em 0 rgba(0, 0, 255, 0.75);
        animation: glitch 500ms infinite;
    }
    ```

-   **Holographic Card:**
    ```css
    .cyber-card {
        background: linear-gradient(135deg, 
            rgba(255, 255, 255, 0.1) 0%,
            rgba(255, 255, 255, 0.05) 100%
        );
        backdrop-filter: blur(10px);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform-style: preserve-3d;
        transition: all 0.3s ease;

        &:hover {
            transform: translateY(-5px) rotateX(5deg) rotateY(5deg);
            box-shadow: 
                0 0 20px rgba(255, 13, 106, 0.5),
                0 0 40px rgba(0, 255, 255, 0.3);
        }
    }
    ```

----------

## **12. Responsive Design:**

-   Ensure  **Cyberpunk theme consistency**  across all screen sizes.
-   For smaller screens,  **adjust neon intensity**  to avoid overwhelming users.

----------

## **13. Images and Media:**

-   Apply a  **dark overlay**  to images to maintain consistency.
-   **Duotone effects**  with neon colors on images to maintain the theme.

----------

## **14. Laravel Directory Structure:**

A clean and modular directory structure is essential for maintaining scalability, especially as the application grows. Here's a detailed breakdown of the  **Laravel directory structure**  tailored for your  **Cyberpunk**  theme project:

### **1. Main Directories Breakdown:**

-   **app/**
    
    -   **Http/**
        -   **Controllers/**: All your  **controller classes**  for handling business logic and interacting with views (via Inertia.js). Ensure controllers follow the  **single responsibility principle**  and have  **RESTful routes**.
            -   Example:  
                `UserController.php`,  `ProductController.php`,  `TransactionController.php`
        -   **Middleware/**: Any  **middleware**  used for request filtering, authentication, or throttling should be here.
        -   **Requests/**: Custom  **Form Request validation classes**  to handle validation logic separately from controllers.  
            Example:  
            `CreateUserRequest.php`,  `UpdateProductRequest.php`
        -   **Resources/**: The  **Inertia controllers**  that return Vue.js components as responses. You can use this to ensure a seamless SPA experience.  
            Example:  
            `HomeController.php`  (returns  `home.vue`  page),  `MarketplaceController.php`  (returns  `marketplace.vue`  page)
-   **app/Models/**:
    
    -   Keep your  **Eloquent models**  here. Each model represents a table in the database and should follow the naming convention and structure.  
        Example:  
        `User.php`,  `Product.php`,  `Transaction.php`
-   **app/Services/**:
    
    -   Keep service classes here to handle complex logic that doesn't belong in controllers. These services will provide methods for interacting with external systems or running complex operations.
    -   Example:  
        `ProductService.php`  (logic for product inventory),  `PaymentService.php`  (for handling payments through external APIs)
-   **app/Repositories/**:
    
    -   Use the  **Repository Pattern**  to abstract database queries and enhance code readability and maintainability.
    -   Example:  
        `UserRepository.php`,  `ProductRepository.php`
-   **config/**:
    
    -   Configuration files for your app (database, caching, etc.).
    -   Example:  
        `database.php`,  `cache.php`,  `services.php`  for third-party services (like Cloudflare R2, Stripe API, etc.).
-   **database/**
    
    -   **migrations/**:  
        Migrations should follow a clear naming convention to ensure ordering (e.g.,  `0001_01_01_000001_create_users_table.php`).
        -   Each migration should handle a  **single database table**, ensuring that future changes are easier to manage.
        -   Example:  
            `0001_01_01_000001_create_users_table.php`,  `0002_01_01_000002_create_transactions_table.php`
    -   **factories/**:  
        Factory classes used for seeding the database with fake data during development.
        -   Example:  
            `UserFactory.php`,  `ProductFactory.php`
    -   **seeds/**:  
        Used to populate the database with initial data.
        -   Example:  
            `DatabaseSeeder.php`,  `ProductSeeder.php`
-   **resources/**
    
    -   **js/**
        -   **Pages/**:  
            This directory holds  **Vue.js pages**  that Inertia will render as views. These files correspond to  **Inertia controllers**.
            -   Example:  
                `Home.vue`,  `Marketplace.vue`,  `ProductDetail.vue`
        -   **Components/**:  
            Keep all your  **reusable Vue components**  here.
            -   Example:  
                `Navbar.vue`,  `Footer.vue`,  `ProductCard.vue`
        -   **Layouts/**:  
            Layout components that structure your pages.
            -   Example:  
                `AppLayout.vue`,  `DashboardLayout.vue`
        -   **Assets/**:  
            Keep your static files like  **CSS**,  **JavaScript**, and  **images**.
            -   Example:  
                `app.css`,  `app.js`,  `background.png`
    -   **views/**:
        -   Blade views for any non-SPA pages or fallback views, especially for  **emails**,  **error pages**, etc.
        -   Example:  
            `emails/welcome.blade.php`,  `errors/404.blade.php`
-   **routes/**
    
    -   **web.php**:  
        This is where your  **Inertia routes**  and any  **traditional routes**  for Blade views should be defined.
        -   Example:  
            `Route::get('/home', [HomeController::class, 'index']);`
    -   **api.php**:  
        Define your  **API routes**  if you're exposing APIs (though Inertia reduces the need for them).  
        Example:  
        `Route::post('/transactions', [TransactionController::class, 'store']);`

### **2. Additional Key Folders:**

-   **public/**:
    
    -   **assets/**: Store public assets (e.g., images, styles, or JavaScript files) in the  **public**  directory for easy access by the browser.
    -   **favicon.ico**,  **robots.txt**  for web SEO and branding consistency.
-   **storage/**:
    
    -   Store  **logs**,  **sessions**, and file uploads here (such as user images, product images, or file uploads to  **Cloudflare R2**).
    -   Ensure  **symlinks**  for storage directories (`php artisan storage:link`).
-   **tests/**:
    
    -   **Feature/**: Test the core functionality of your app, ensuring controllers, services, and important logic work as expected.
        -   Example:  
            `CreateUserTest.php`,  `StoreTransactionTest.php`
    -   **Unit/**: Test individual units of functionality, typically services or small functions.
        -   Example:  
            `ProductServiceTest.php`,  `PaymentGatewayTest.php`
-   **resources/views/layouts**:
    
    -   Use  **layouts**  for structured, reusable page wrappers, e.g.,  `AppLayout.vue`  to handle the consistent layout across the website with your cyberpunk design.

### **3. Naming Conventions:**

-   **Controller Naming**: Keep controllers  **singular**, e.g.,  `UserController`,  `ProductController`.
-   **Model Naming**: Models should be  **singular**  as well, e.g.,  `User`,  `Product`.
-   **Service Class Naming**: Services should follow  **action-based naming**  like  `PaymentService`,  `ProductService`.
-   **Repository Naming**: Repositories should follow the naming convention of the resource they manage, e.g.,  `UserRepository`,  `ProductRepository`.
-   **Migration Naming**: Migrations should be  **timestamped**  and follow this format:  
    `YYYY_MM_DD_HHMMSS_create_table_name.php`. Example:  `0001_01_01_000001_create_users_table.php`.

### **Final Notes:**

By following this  **Laravel directory structure**, you ensure that your code remains modular, scalable, and maintainable. The clean separation of concerns between controllers, models, services, and repositories allows for easy updates and improvements over time. This structure helps in keeping your  **Cyberpunk theme**  organized and flexible for future changes.
