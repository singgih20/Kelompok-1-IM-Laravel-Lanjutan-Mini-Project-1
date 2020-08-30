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

**Post Data**
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
**Route Api**
<pre>
/api/register
</pre>

## Login
**Post Data**
```json
{
    "username": "dediananto",
    "password": "123456"
}

```
**Route Api**
<pre>
/api/login
</pre>

## Logout
_Use Bearer Token for Authorization_  
**Route Api**
<pre>
/api/logout
</pre>  

## Insert Books
<pre>
/api/create-new-book
</pre>

**Create Data**
```json
{
    "title": "contoh judul",
    "description": "contoh description",
    "author": "Contoh author",
    "publisher": "contoh publisher",
    "price" : 5.500,
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
