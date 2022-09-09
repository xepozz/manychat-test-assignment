# ManyChat Test assignment

## Original goal:

Emulate ATM work where ATM should give banknotes as high as possible.
ATM should try to combine banknotes if it's impossible to give only higher banknotes.

## Running instruction

1. Clone the repository
    ```
    git clone git@github.com:xepozz/manychat-test-assignment
    ```
2. Install dependencies
    ```bash
    composer install
    ```
3. Run tests
    ```bash
    ./vendor/bin/phpunit tests
    ```

## Test cases

### Stage 1

Banknotes in use:

`100, 50`

1. If user asks for `100` ATM should give `[100]`
2. If user asks for `150` ATM should give `[100, 50]`
3. If user asks for `250` ATM should give `[100, 100, 50]`

### Stage 2

Banknotes in use, also they are limited by number:
`100 => 2, 50 => 3`

1. If user asks for `100` ATM should give `[100]`
2. If user asks for `150` ATM should give `[100, 50]`
3. If user asks for `250` ATM should give `[100, 100, 50]`
4. If user asks for `350` ATM should give `[100, 100, 50, 50, 50]`

### Stage 3

Banknotes in use, also they are limited by number:
`100 => 2, 50 => 3, 30 => 4`

1. If user asks for `100` ATM should give `[100]`
2. If user asks for `150` ATM should give `[100, 50]`
3. If user asks for `250` ATM should give `[100, 100, 50]`
4. If user asks for `350` ATM should give `[100, 100, 50, 50, 50]`
5. If user asks for `60` ATM should give `[30, 30]`
6. If user asks for `120` ATM should give `[30, 30, 30, 30]`
7. If user asks for `160` ATM should give `[100, 30, 30]`

### Failure cases

Banknotes in use, also they are limited by number:
`100 => 2, 50 => 3, 30 => 4`

1. If user asks for `500` ATM should **fail**
2. If user asks for `15` ATM should **fail**
3. If user asks for `140` ATM should **fail**

