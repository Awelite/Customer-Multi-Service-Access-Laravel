# Customer Multi-Service Access Platform (Laravel 12)

A web-based platform for connecting **customers** with **service providers** (plumbers, electricians, AC service, etc.) through a single portal.  
Built using **Laravel 12**, **Bootstrap 5**, and **MySQL**, with role-based dashboards for Admin, Providers, and Customers.

---

## 🚀 Features

### 🔹 **Authentication & Role Management**
- Role-based login redirects (Admin, Customer, Provider, Staff)
- Provider registration with custom fields (DOB, gender, experience, documents)
- Middleware for role-based access
- Provider approval system

### 🔹 **Customer Module**
- Customer Dashboard
- Search and filter providers by category & city
- View provider profiles (photo, category, ratings placeholder)
- Submit service requests
- Track request statuses (Pending, Accepted, Rejected, Completed)
- View provider contact info after acceptance

### 🔹 **Provider Module**
- Custom registration form with personal details and ID proof
- Access dashboard only after admin approval
- View assigned service requests
- Accept or reject requests
- View customer details after accepting

### 🔹 **Admin Module**
- Admin Dashboard with total counts:
  - Customers, Providers, Services, Requests
- Manage providers:
  - View, approve, reject, and see uploaded documents
- Manage service requests:
  - Change request status
  - Assign staff
- Manage services (Add, Edit, Delete)
- Email notifications for new requests

### 🔹 **Notifications**
- Email notification to provider when a customer requests a service
- Professional email template

---

## 🛠 Tech Stack
- **Backend:** Laravel 12 (PHP)
- **Frontend:** Laravel Blade + Bootstrap 5
- **Database:** MySQL
- **Email Service:** SMTP / Gmail
- **Hosting:** Laravel-compatible hosting or local XAMPP setup

---

## 📌 Database Models & Relationships
- **User** – for customers, providers, staff, and admins
- **Provider** – extra info for providers
- **Service** – service categories
- **ServiceRequest** – customer requests
- Relationships:
  - ServiceRequest → belongsTo User (customer)
  - ServiceRequest → belongsTo Provider
  - ServiceRequest → belongsTo Service

---

## 📷 Screenshots
(Add relevant project screenshots here — Admin dashboard, provider registration form, service request flow, etc.)

---

## 🔮 Future Improvements
- Activity logs for admin (who did what & when)
- Ratings & reviews for providers
- Geolocation-based provider search
- More detailed analytics on the admin dashboard

---

## 📄 License & Credits
This project is built on **Laravel**, an open-source PHP framework.  
Laravel is licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author
This project was developed as part of our Internship Project by our team:

- *Hassibul Kausir* (Lead Developer)  
- *Kuddus Ali*  
- *Muhammed Mahmudul Hassan*  
- *Nadir Sa Alom*
