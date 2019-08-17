# survey builder [![Build Status](https://travis-ci.org/rnambaale/survey-builder.svg?branch=master)](https://travis-ci.org/rnambaale/survey-builder)

Simple Survey management Application

## Getting Started

Clone the project repository by running the command below if you use SSH

```bash
git clone git@github.com:rnambaale/survey-builder.git
```

If you use https, use this instead

```bash
git clone https://github.com/rnambaale/survey-builder.git
```

After cloning, run:

```bash
composer install
```

```bash
npm install
```

Duplicate `.env.example` and rename it `.env`

Then run:

```bash
php artisan key:generate
```

### Prerequisites

Be sure to fill in your database details in your `.env` file before running the migrations:

```bash
php artisan migrate
```

And finally, start the application:

```bash
php artisan serve
```

and visit [http://localhost:8000](http://localhost:8000) to see the application in action.

### Todo

1. Administrator should be able to download the results in excel
