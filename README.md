
API Endpoints:

Base URL: http://localhost:8000/api

| Method | Endpoint         | Description            | Auth Required |
| ------ | ---------------- | ---------------------- | ------------- |
| POST   | `/auth/login`    | Login with credentials | ❌            |
| GET    | `/events/`       | Fetch events           | ❌            |
| GET    | `/bookings/`     | Fetch user bookings    | ✅            |
| POST   | `/bookings/`     | Save user booking      | ✅            |


Database Schema:
```sql
model User {
  id        Int      @id @default(autoincrement())
  name      String
  email     String   @unique
  password  String
  created_at DateTime @default(now())
  updated_at DateTime @default(now())
}

model Event {
  id             Int      @id @default(autoincrement())
  title          String
  is_available   Boolean
  capacity       Int
  price          Int
  date           DateTime 
  created_at DateTime @default(now())
  updated_at DateTime @default(now())
}

model Bookings {
  id             Int      @id @default(autoincrement())
  user_id        Int      @unique
  event_id       Int      @unique
  created_at DateTime @default(now())
}
```

Run Backend:

php artisan serve --port=8000

Run Frontend: 

npm run dev

Note: Sign up user from backend then you can use that user to login from frontend
