# Code Style Guidelines

## Table of Contents

- [PSR-1: Basic Coding Standard](#psr-1-basic-coding-standard)
- [PSR-12: Extended Coding Style Guide](#psr-12-extended-coding-style-guide)
- [PSR-4: Autoloader](#psr-4-autoloader)
- [PER Coding Style](#per-coding-style)

---

### PSR-1: Basic Coding Standard

[PSR-1](https://www.php-fig.org/psr/psr-1/) sets the basic coding standard, forming the groundwork for all other PSR standards. Adhere to these essential elements of PHP code such as naming conventions, file organization, and class structures. Key directives include:

- Use only `<?php` and `<?=` tags.
- Employ UTF-8 without BOM for PHP code.
- Declare one class per file.
- Follow an "autoloading" PSR (PSR-4) for namespaces and classes.

#### Classes

- Declare class names in `StudlyCaps`.
- Contain each class in its own file.
- Match the filename with the class name. For instance, a class `MyClassName` should reside in a file named `MyClassName.php`.

#### Interfaces

- Declare interface names in `StudlyCaps`.
- Similar to classes, place each interface in its own file.
- Match the filename with the interface name, suffixed with Interface. For instance, `src\Interfaces\MyInterface.php`.

#### Traits

- Declare trait names in `StudlyCaps`.
- Place each trait in its own file.
- Match the filename with the trait name, suffixed with Trait. For example, `src\Interfaces\MyTrait.php`.

### PSR-12: Extended Coding Style Guide

#### Methods

- Declare method names in `camelCase()`.
- Begin with a verb. For example, `calculateSum()`, `getUserName()`.

#### Properties

- Declare property names in `$camelCase`.
- Begin with a noun. For example, `$propertyName`, `$objectList`.

#### Constants

- Declare constant names in uppercase letters with underscores separating words. For example, `MAXIMUM_VALUE`.
- Define constants within the relevant scope.

### PSR-12: Extended Coding Style Guide

[PSR-12](https://www.php-fig.org/psr/psr-12/) builds upon PSR-1 with detailed rules for code formatting, covering indentation, line endings, whitespace, `declare` statements, and `use` statements.

### PSR-4: Autoloader

[PSR-4](https://www.php-fig.org/psr/psr-4/) introduces a standardized autoloading mechanism for PHP classes, ensuring easy integration with Composer's autoloading capabilities. PSR-4 specifies:

- Autoloading classes from file paths.
- Full interoperability with other autoloading specifications, including PSR-0.
- File placement for auto-loaded files according to the specification.

### PER Coding Style

PER (PHP Extended Recommendations) provides extended coding style guidelines complementing the PSR standards. It emphasizes:

- Consistency and readability.
- Clear separation of concerns.
- Enhanced readability and maintainability.

Adhere to these standards to ensure compatibility with other PHP projects, follow widely accepted best practices, and make your code easier for developers to understand and maintain.
