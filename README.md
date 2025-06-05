# AcmeWidget Shopping Basket

This is a PHP implementation of a shopping basket system for Acme Widget Co. The system calculates the total price of products, applies special offers, and adds appropriate delivery costs based on the total order value.

## Features

- Add products to the basket
- Apply special offers (e.g., buy one red widget, get the second half price)
- Calculate delivery costs based on order value thresholds
- Calculate final total with appropriate rounding

## Requirements

- [Docker](https://www.docker.com/) and Docker Compose
- (Optional) PHP 8.2+ and Composer, if you prefer to run the app without Docker

## Installation

This project uses Docker to ensure consistent environments.

To install dependencies:

```bash
make install
```

> This command runs Composer inside a Docker container. Make sure Docker is installed and running.

### Local (non-Docker) alternative

If you prefer to use your local PHP and Composer installation:

```bash
composer install
```

> Note: Your local environment must match the PHP version and extensions defined in the container.

## Available Products

| Product       | Code  | Price  |
|---------------|-------|--------|
| Red Widget    | R01   | $32.95 |
| Green Widget  | G01   | $24.95 |
| Blue Widget   | B01   | $7.95  |

## Delivery Rules

- Orders under $50: Delivery cost $4.95
- Orders under $90: Delivery cost $2.95
- Orders $90 or over: Free delivery

## Special Offers

- Buy one Red Widget, get the second half price

## Testing

Run the test suite:

- Using Docker
```bash
make test
```
- Local(non-Docker) alternative
```bash
composer test
```
