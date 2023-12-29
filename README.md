# Laratrust

A modern and framework-agnostic authorization and authentication package featuring roles, permissions, custom hashing algorithms and additional security features.

The package follows the FIG standard PSR-4 to ensure a high level of interoperability between shared PHP code.

### 📦 Requirements

The package requires PHP 8.0+ and comes bundled with a Laravel 10 Facade and a Service Provider to simplify the optional framework integration.

### 📋 Features

- Authentication.
- Authorization.
- Registration.
- Users & Roles Management.
- Driver based permission system.
- Flexible activation scenarios.
- Reminders (password reset).
- Inter-account throttling with DDoS protection.
- Custom hashing strategies.
- Multiple sessions.
- Multiple login columns.
- Integration with Laravel.
- Allow use of multiple ORM implementations.
- Native facade for easy usage outside Laravel.
- Interface driven (your own implementations at will).

### 🔧 Installation

Install the package with the below command:

```sh
composer require hitechnix/laratrust
```

### 📝 Usage

Reader-friendly documentation can be found [here][link-docs].

### 📨 Message

I hope you find this useful. If using the package, but you're stuck? Found a bug? Have a question or suggestion for improving this package? Feel free to create an issue on GitHub, we'll try to address it as soon as possible.

### 🔐 Security

If you discover any security-related issues, please email support@hitechnix.com instead of using the issue tracker.

### 📖 License

This software is released under the [BSD 3-Clause][link-license] License. Please see the [LICENSE](LICENSE) file
or https://opensource.hitechnix.com/LICENSE.txt for more information.

### ✨ Contributors

Thanks goes to these wonderful people ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <td align="center" valign="top" width="14.28%">
    <a href="https://trants.io">
      <img src="https://avatars.githubusercontent.com/u/40693126?v=4?s=100" width="100px;" alt="Son Tran Thanh" />
      <br />
      <sub>
        <b>Son Tran Thanh</b>
      </sub>
    </a>
    <br />
    <a href="#maintenance-trants" title="Maintenance">🚧</a>
    <a href="https://github.com/hitechnix/laratrust/commits?author=trants" title="Code">💻</a>
  </td>
</table>

<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->

This project follows the [all-contributors](https://allcontributors.org) specification.
Contributions of any kind welcome!

[link-docs]: https://opensource.hitechnix.com/manual/laratrust
[link-license]: https://opensource.org/license/bsd-3-clause
