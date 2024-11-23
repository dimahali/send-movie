# Send The Movie

**Express Your Feelings Through Movies**

Send The Movie is an open-source Laravel application that enables users to convey their emotions by sharing personalized messages alongside their favorite films. Whether it's to express love, gratitude, or simply to recommend a must-watch, our platform facilitates heartfelt connections through the magic of cinema.

## Features
- **Personalized Messaging:** Create funny/meaningful messages to accompany your selected movies.
- **Extensive Movie Library:** Explore a wide collection of films to find the perfect match for your message.
- **User-Friendly Interface:** Navigate effortlessly through a clean and intuitive design.
- **Dark Mode Toggle:** Switch between light and dark themes for a comfortable viewing experience.
- **More features to come...**

## Demo
Check out the live application at [Send The Movie](https://send.movie).
Submit new message [New Message](https://send.movie/now).

## Installation
To set up Send The Movie locally, follow these steps:

1. **Clone the repository:**
   ```
   git clone https://github.com/yourusername/send-the-movie.git
   ```
2.  **Navigate to the project directory:**
    ```
    cd send-movie
    ``` 
3.  **Install dependencies:**
    ```
    composer install
    npm install
    ``` 

4.  **Copy the example environment file and configure your environment variables:**

    ```
    cp .env.example .env
    ``` 
    Update the `.env` file with your database and other necessary configurations i.e. TMDB token to get video detail and google and fb for social login.

5.  **Generate an application key:**

    `php artisan key:generate`

6.  **Run database migrations:**

    `php artisan migrate`

7.  **Start the development server:**

    `php artisan serve`

    The application will be accessible at http://localhost:8000.

## License

This project is licensed under the MIT License. See the LICENSE file for more details.

## Acknowledgements

We extend our gratitude to all contributors and users who have supported and inspired the development of Send The Movie.

## Contact

For questions, suggestions, or feedback, please open an issue on GitHub or contact us at support@send.movie.
