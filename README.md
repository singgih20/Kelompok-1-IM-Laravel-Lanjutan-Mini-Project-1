# Kelompok 1 Mini Project 1  
Studi kasus API Toko Buku Online  

Bootcamp [Sanbercode](http://sanbercode.com/) Kelas Laravel Lanjutan

#To do list setelah clone project
1. composer install
2. copy .env.example ke .env, sesuaikan dengan local.
3. php artisan jwt:secret
4. php artisan cache:clear
5. php artisan config:clear
6. php artisan migrate:refresh (karena saya ada beberapa table yang saya ubah kolomnya).

---
## Register User

**Create User**
```json
{
    "name": "John Doe",
    "username": "john2020",
    "phone": "08123456789",
    "password": "123456",
    "roles": "admin"
}

```
_note : jika role tidak diisi akan diset defaultnya guest_  
<pre>
post /api/register
</pre>

## Login
```json
{
    "username": "john2020",
    "password": "123456"
}

```
<pre>
post /api/login
</pre>

## Logout
_Use Bearer Token for Authorization_  
<pre>
post /api/logout
</pre>  

## Insert Books
<pre>
post /api/create-new-book
</pre>

**Create Data**
```json
{
    "title": "contoh judul",
    "description": "contoh description",
    "author": "Contoh author",
    "publisher": "contoh publisher",
    "price" : 5500,
    "stock" : 4
    
}
```
## Show Books / show books by id
<pre>
get /api/book
get /api/book/1
</pre>

## Update books by id
<pre>
patch /api/update-book/1
</pre>

**update data**
```json
{
    "title" "ubah title"
}
```

## Delete books by id
<pre>
delete /api/delete-book/1
</pre>

## order book

**order data**  
```json
{
    "book_id": 1,
    "quantity": 2
}
```

<pre>
post /api/order
</pre>

## update status order berdasarkan invoice number

**status order**  
```json
{
    "action": "PROCESS"
}
```

<pre>
patch /api/update-status/INV-0820-5f4b95db6fcae
</pre>

## history order
<pre>
get /api/history
</pre>  
_admin akan memunculkan semua history, untuk user biasa hanya akan muncul history dia sendiri_  