# CyberWallet - Ethereum Wallet Tracker

A cyberpunk-themed Ethereum wallet tracking application built with Laravel, Vue.js, and Inertia.js.

## Features

- 🔐 Track multiple Ethereum wallets
- 💰 Monitor ETH and token balances
- 📊 Transaction history tracking
- 🎨 Cyberpunk 2077-inspired UI
- 🔄 Real-time balance updates
- 📱 Responsive design

## Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Vue 3
- **Styling:** Tailwind CSS
- **Routing:** Inertia.js
- **API:** Etherscan API
- **Database:** PostgreSQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/cyberwallet.git
cd cyberwallet
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up your database in `.env`:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=cyberwallet
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Add your Etherscan API key:
```
ETHERSCAN_API_KEY=your_api_key
```

6. Run migrations:
```bash
php artisan migrate
```

7. Build assets:
```bash
npm run dev
```

8. Start the server:
```bash
php artisan serve
```

## Usage

1. Register an account
2. Add Ethereum wallets to track
3. View wallet balances and transactions
4. Monitor token holdings
5. Refresh wallet data as needed

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Cyberpunk 2077 for design inspiration
- Etherscan for blockchain data
- Laravel & Vue.js communities
