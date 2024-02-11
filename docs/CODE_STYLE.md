# Code Style Guidelines

---

## Table of Contents

- [PSR-1: Basic Coding Standard](#psr-1-basic-coding-standard)
- [PSR-12: Extended Coding Style Guide](#psr-12-extended-coding-style-guide)
- [PSR-4: Autoloader](#psr-4-autoloader)
- [PER Coding Style](#per-coding-style)

### PSR-1: Basic Coding Standard

[PSR-1](https://www.php-fig.org/psr/psr-1/) is the basic coding standard that serves as the foundation for all other PSR standards. It focuses on essential elements of PHP code such as naming conventions, file organization, and class structures. Key aspects include:

- Using only `<?php` and `<?=` tags.
- Using UTF-8 without BOM for PHP code.
- Declaring one class per file.
- Namespaces and classes must follow an "autoloading" PSR (PSR-4).

#### Classes

- Class names should be declared in `StudlyCaps`.
- Each class should be contained in its own file.
- The filename should match the class name. For example, a class `MyClassName` should be declared in a file named `MyClassName.php`.

#### Interfaces

- Interface names should be declared in `StudlyCaps`.
- Similar to classes, each interface should be contained in its own file.
- The filename should match the interface name. For example, an interface `MyInterface` should be declared in a file named `MyInterface.php`.
- Interfaces must be suffixed with Interface. For example, `src\Interfaces\MyInterface.php`

#### Traits

- Trait names should be declared in `StudlyCaps`.
- Each trait should be contained in its own file.
- The filename should match the trait name. For example, a trait `MyTrait` should be declared in a file named `MyTrait.php`.
- Traits must be suffixed with Trait, for example, `src\Interfaces\MyTrait.php`

### PSR-12: Extended Coding Style Guide

#### Methods

- Method names should be declared in `camelCase()`.
- The first word should be a verb. For example, `calculateSum()`, `getUserName()`.

#### Properties

- Property names should be declared in `$camelCase`.
- The first word should be a noun. For example, `$propertyName`, `$objectList`.

#### Constants

- Constant names should be declared in uppercase letters with underscores separating words. For example, `MAXIMUM_VALUE`.
- Constants should be defined within the scope where they are relevant.

### PSR-12: Extended Coding Style Guide

[PSR-12](https://www.php-fig.org/psr/psr-12/) extends PSR-1 with more detailed rules for code formatting. It covers topics such as:

- Indentation, line ending characters, and whitespace issues.
- Proper placement of `declare` statements when present.
- Omitting closing PHP tags in files containing only PHP code.
- Correct use of `use` statements.

### PSR-4: Autoloader

[PSR-4](https://www.php-fig.org/psr/psr-4/) introduces a standardized autoloading mechanism for PHP classes. It ensures that your library can easily integrate with Composer's autoloading capabilities, making it easier for others to use your code. PSR-4 defines:

- A specification for autoloading classes from file paths.
- Fully interoperable with any other autoloading specification, including PSR-0.
- Where to place files that will be auto-loaded according to the specification.

### PER Coding Style

PER stands for PHP Extended Recommendations, which is a set of extended coding style guidelines that complement the PSR standards. It generally refers to a stricter version of PSR-2, which has been deprecated in favor of PSR-12. PER emphasizes:

- Consistent and readable code.
- Clear separation of concerns.
- Enhanced readability and maintainability.

By adhering to these standards, you ensure that your library is compatible with other PHP projects, follows widely accepted best practices, and is easier for developers to understand and maintain.
