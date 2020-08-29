# Kelompok 1 Mini Project 1  
Studi kasus API Toko Buku Online  

Bootcamp [Sanbercode](http://sanbercode.com/) Kelas Laravel Lanjutan

---
## Register User

**Post Data**
```json
{
    "name": "Dedi Ananto",
    "username": "dediananto",
    "phone": "085866690661",
    "password": "123456",
    "roles": "admin"
}

```
_note : jika role tidak diisi akan diset defaultnya guest_  
**Route Api**
<pre>
api/register
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
api/login
</pre>

## Logout
_Use Bearer Token for Authorization_  
**Route Api**
<pre>
api/logout
</pre>  
