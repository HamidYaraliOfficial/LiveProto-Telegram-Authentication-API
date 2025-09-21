# English - LiveProto Telegram Authentication API

## Project Overview
The LiveProto Telegram Authentication API is a PHP-based solution for seamless Telegram account authentication using the LiveProto library. This API handles the complete authentication flow including phone number verification, SMS code validation, email verification, password authentication, and account signup. It supports multiple authentication steps and provides JSON responses with multilingual support for English, Persian, Chinese, and Russian languages. The API automatically manages LiveProto library installation and configuration for easy deployment.

## Features
- **Complete Authentication Flow**: Handles phone verification, SMS code, email verification, password authentication, and signup processes.
- **Multilingual Support**: JSON responses in English, Persian, Chinese, and Russian for global accessibility.
- **Auto-Installation**: Automatically downloads and configures the LiveProto library if not present.
- **Error Handling**: Comprehensive error management with multilingual error messages.
- **Session Management**: Uses SQLite for session storage with phone-specific client instances.
- **Device Emulation**: Configures realistic device settings for reliable authentication.

## Prerequisites
- PHP 8.0 or higher
- cURL extension enabled
- `allow_url_fopen` enabled for automatic LiveProto installation
- SQLite support for session storage
- Write permissions for library files

## Installation and Setup
1. Download the repository.
2. Ensure PHP server is configured with required extensions.
3. Place the `liveproto_auth.php` file in your web directory.
4. Make the directory writable for automatic LiveProto installation.
5. Access the API via HTTP POST/GET requests with required parameters.

## API Usage

### Authentication Steps

**1. Send Phone Verification Code**
```
POST /liveproto_auth.php
phone=989123456789
```
Response: `{"ok":true,"result":{"phone_code_hash":"abc123","en":"Verification code sent successfully"}}`

**2. Verify SMS Code**
```
POST /liveproto_auth.php
phone=989123456789
code=12345
```
Response: `{"ok":true,"result":{"user":{"id":123456789},"en":"Successfully signed in with verification code"}}`

**3. Email Verification (if required)**
```
POST /liveproto_auth.php
phone=989123456789
email=user@example.com
```
Response: `{"ok":true,"result":{"en":"Email verification code sent"}}`

**4. Verify Email Code**
```
POST /liveproto_auth.php
phone=989123456789
code=ABC123
```
Response: `{"ok":true,"result":{"en":"Email verified successfully"}}`

**5. Password Authentication (if 2FA enabled)**
```
POST /liveproto_auth.php
phone=989123456789
password=your_password
```
Response: `{"ok":true,"result":{"user":{"id":123456789},"en":"Successfully signed in with password"}}`

## Response Format
```json
{
  "ok": true,
  "result": {
    "en": "English message",
    "fa": "Persian message", 
    "zh": "Chinese message",
    "ru": "Russian message",
    "user": {...},
    "phone_code_hash": "..."
  }
}
```

## Developer
Developed by Hamid Yarali  
- GitHub: https://github.com/HamidYaraliOfficial  
- Instagram: https://www.instagram.com/hamidyaraliofficial?igsh=MWpxZjhhMHZuNnlpYQ==  
- Telegram: @Hamid_Yarali  

## License
This project is licensed under the MIT License.

---

# فارسی - API احراز هویت تلگرام LiveProto

## معرفی پروژه
API احراز هویت تلگرام LiveProto یک راه‌حل مبتنی بر PHP برای احراز هویت یکپارچه حساب‌های تلگرام با استفاده از کتابخانه LiveProto است. این API کل فرآیند احراز هویت شامل تأیید شماره تلفن، اعتبارسنجی کد SMS، تأیید ایمیل، احراز هویت با رمز عبور و ثبت‌نام حساب را مدیریت می‌کند. این API از مراحل مختلف احراز هویت پشتیبانی می‌کند و پاسخ‌های JSON با پشتیبانی چندزبانه برای زبان‌های فارسی، انگلیسی، چینی و روسی ارائه می‌دهد. API به‌صورت خودکار نصب و پیکربندی کتابخانه LiveProto را برای استقرار آسان مدیریت می‌کند.

## ویژگی‌ها
- **جریان کامل احراز هویت**: مدیریت تأیید تلفن، کد SMS، تأیید ایمیل، احراز هویت رمز عبور و فرآیند ثبت‌نام.
- **پشتیبانی چندزبانه**: پاسخ‌های JSON به زبان‌های فارسی، انگلیسی، چینی و روسی برای دسترسی جهانی.
- **نصب خودکار**: دانلود و پیکربندی خودکار کتابخانه LiveProto در صورت عدم وجود.
- **مدیریت خطا**: مدیریت جامع خطاها با پیام‌های خطای چندزبانه.
- **مدیریت جلسه**: استفاده از SQLite برای ذخیره‌سازی جلسه با نمونه‌های کلاینت خاص تلفن.
- **شبیه‌سازی دستگاه**: پیکربندی تنظیمات دستگاه واقعی برای احراز هویت قابل اعتماد.

## پیش‌نیازها
- PHP نسخه 8.0 یا بالاتر
- افزونه cURL فعال
- `allow_url_fopen` فعال برای نصب خودکار LiveProto
- پشتیبانی SQLite برای ذخیره‌سازی جلسه
- مجوز نوشتن برای فایل‌های کتابخانه

## نصب و راه‌اندازی
1. مخزن را دانلود کنید.
2. اطمینان حاصل کنید سرور PHP با افزونه‌های مورد نیاز پیکربندی شده است.
3. فایل `liveproto_auth.php` را در دایرکتوری وب خود قرار دهید.
4. دایرکتوری را برای نصب خودکار LiveProto قابل نوشتن کنید.
5. از طریق درخواست‌های HTTP POST/GET با پارامترهای مورد نیاز به API دسترسی پیدا کنید.

## استفاده از API

### مراحل احراز هویت

**1. ارسال کد تأیید تلفن**
```
POST /liveproto_auth.php
phone=989123456789
```
پاسخ: `{"ok":true,"result":{"phone_code_hash":"abc123","fa":"کد تأیید با موفقیت ارسال شد"}}`

**2. تأیید کد SMS**
```
POST /liveproto_auth.php
phone=989123456789
code=12345
```
پاسخ: `{"ok":true,"result":{"user":{"id":123456789},"fa":"با موفقیت با کد تأیید وارد شدید"}}`

**3. تأیید ایمیل (در صورت نیاز)**
```
POST /liveproto_auth.php
phone=989123456789
email=user@example.com
```
پاسخ: `{"ok":true,"result":{"fa":"کد تأیید ایمیل ارسال شد"}}`

**4. تأیید کد ایمیل**
```
POST /liveproto_auth.php
phone=989123456789
code=ABC123
```
پاسخ: `{"ok":true,"result":{"fa":"ایمیل با موفقیت تأیید شد"}}`

**5. احراز هویت با رمز عبور (در صورت فعال بودن 2FA)**
```
POST /liveproto_auth.php
phone=989123456789
password=your_password
```
پاسخ: `{"ok":true,"result":{"user":{"id":123456789},"fa":"با موفقیت با رمز عبور وارد شدید"}}`

## فرمت پاسخ
```json
{
  "ok": true,
  "result": {
    "fa": "پیام فارسی",
    "en": "English message",
    "zh": "Chinese message",
    "ru": "Russian message",
    "user": {...},
    "phone_code_hash": "..."
  }
}
```

## توسعه‌دهنده
توسعه داده شده توسط حمید یارعلی  
- GitHub: https://github.com/HamidYaraliOfficial  
- Instagram: https://www.instagram.com/hamidyaraliofficial?igsh=MWpxZjhhMHZuNnlpYQ==  
- Telegram: @Hamid_Yarali  

## لایسنس
این پروژه تحت مجوز MIT منتشر شده است.

---

# 中文 - LiveProto 电报认证 API

## 项目概述
LiveProto 电报认证 API 是一个基于 PHP 的解决方案，用于使用 LiveProto 库进行无缝电报账户认证。该 API 处理完整的认证流程，包括电话号码验证、SMS 验证码验证、电子邮件验证、密码认证和账户注册。它支持多个认证步骤，并为英语、波斯语、中文和俄语提供多语言 JSON 响应。该 API 自动管理 LiveProto 库的安装和配置，便于轻松部署。

## 功能
- **完整认证流程**：处理电话验证、SMS 验证码、电子邮件验证、密码认证和注册流程。
- **多语言支持**：JSON 响应支持英语、波斯语、中文和俄语，实现全球可访问性。
- **自动安装**：如果不存在，则自动下载并配置 LiveProto 库。
- **错误处理**：全面错误管理，带有多语言错误消息。
- **会话管理**：使用 SQLite 进行会话存储，带有特定电话号码的客户端实例。
- **设备仿真**：配置真实的设备设置以确保可靠的认证。

## 前提条件
- PHP 8.0 或更高版本
- 启用 cURL 扩展
- 启用 `allow_url_fopen` 用于自动 LiveProto 安装
- 用于会话存储的 SQLite 支持
- 库文件的写入权限

## 安装与设置
1. 下载存储库。
2. 确保 PHP 服务器配置了所需的扩展。
3. 将 `liveproto_auth.php` 文件放置在您的 web 目录中。
4. 使目录可写以进行自动 LiveProto 安装。
5. 通过带有所需参数的 HTTP POST/GET 请求访问 API。

## API 使用

### 认证步骤

**1. 发送电话验证码**
```
POST /liveproto_auth.php
phone=989123456789
```
响应：`{"ok":true,"result":{"phone_code_hash":"abc123","zh":"验证码发送成功"}}`

**2. 验证 SMS 验证码**
```
POST /liveproto_auth.php
phone=989123456789
code=12345
```
响应：`{"ok":true,"result":{"user":{"id":123456789},"zh":"使用验证码成功登录"}}`

**3. 电子邮件验证（如果需要）**
```
POST /liveproto_auth.php
phone=989123456789
email=user@example.com
```
响应：`{"ok":true,"result":{"zh":"电子邮件验证码已发送"}}`

**4. 验证电子邮件代码**
```
POST /liveproto_auth.php
phone=989123456789
code=ABC123
```
响应：`{"ok":true,"result":{"zh":"电子邮件验证成功"}}`

**5. 密码认证（如果启用 2FA）**
```
POST /liveproto_auth.php
phone=989123456789
password=your_password
```
响应：`{"ok":true,"result":{"user":{"id":123456789},"zh":"使用密码成功登录"}}`

## 响应格式
```json
{
  "ok": true,
  "result": {
    "zh": "中文消息",
    "en": "English message",
    "fa": "Persian message",
    "ru": "Russian message",
    "user": {...},
    "phone_code_hash": "..."
  }
}
```

## 开发者
由 Hamid Yarali 开发  
- GitHub: https://github.com/HamidYaraliOfficial  
- Instagram: https://www.instagram.com/hamidyaraliofficial?igsh=MWpxZjhhMHZuNnlpYQ==  
- Telegram: @Hamid_Yarali  

## 许可证
本项目采用 MIT 许可证发布。