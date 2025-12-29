# Optimed Hastanesi - Modern WordPress Sitesi

Modern, hızlı ve duyarlı tasarıma sahip, performans optimizasyonları ile geliştirilmiş Optimed Hastanesi WordPress sitesi.

[English version](#english-version)

## 🚀 Özellikler

- **Modern Tasarım**: Sağlık sektörüne odaklı temiz, profesyonel tasarım
- **Yüksek Performans**: Lazy loading, önbellekleme ve minifikasyon ile optimize edilmiş hız
- **Duyarlı Tasarım**: Tüm cihazlarda mükemmel çalışan mobil öncelikli tasarım
- **SEO Optimizasyonu**: Yerleşik SEO en iyi uygulamaları ve WordPress SEO eklentisi
- **Güvenli**: Güvenlik başlıkları, Wordfence ve güvenlik en iyi uygulamaları
- **Docker Desteği**: Docker ile kolay yerel geliştirme ortamı
- **Redis Önbellekleme**: Daha hızlı sayfa yüklemeleri için Redis desteği
- **Modern Tema**: Performans odaklı özel geliştirilmiş tema
- **Erişilebilirlik**: WCAG uyumlu ve klavye dostu

## 📋 Gereksinimler

- Docker & Docker Compose (önerilen)
- VEYA PHP 8.1+ ile MySQL 8.0+ ve Nginx/Apache

## 🛠️ Kurulum

### Docker Kullanarak (Önerilen)

1. **Depoyu klonlayın**
   ```bash
   git clone <depo-url>
   cd optimed-site-int
   ```

2. **Docker konteynerlerini başlatın**
   ```bash
   chmod +x setup.sh
   ./setup.sh
   ```
   
   Veya manuel olarak:
   ```bash
   docker compose up -d
   ```

3. **Siteye erişin**
   - Web sitesi: http://localhost:8080
   - phpMyAdmin: http://localhost:8081
   - Kullanıcı adı: root / Şifre: root_password

4. **WordPress kurulumunu tamamlayın**
   - http://localhost:8080 adresini ziyaret edin
   - WordPress kurulum sihirbazını takip edin
   - Önerilen ayarlar:
     - Site Başlığı: Optimed Hastanesi
     - Admin Kullanıcı Adı: admin (bunu değiştirin)
     - Admin Şifresi: (güçlü bir şifre kullanın)
     - Admin E-posta: email@example.com

5. **Temayı etkinleştirin**
   - Görünüm → Temalar'a gidin
   - "Optimed Modern" temasını etkinleştirin

6. **Mevcut içeriği içe aktarın** (İsteğe bağlı)
   - "All-in-One WP Migration" eklentisini yükleyin
   - All-in-One WP Migration → İçe Aktar'a gidin
   - Depodaki .wpress dosyasını yükleyin
   - İçe aktarma işlemi tüm içeriği, ayarları ve yapılandırmaları geri yükleyecektir

## 🎨 Tema Yapılandırması

### Menüler
1. Görünüm → Menüler'e gidin
2. "Ana Menü" oluşturun ve "Ana Menü" konumuna atayın
3. "Alt Bilgi Menüsü" oluşturun ve "Alt Bilgi Menüsü" konumuna atayın

### Widget'lar
Tema aşağıdaki widget alanlarını destekler:
- Kenar çubuğu (yazılar/sayfalar için sağ kenar çubuğu)
- Alt Bilgi 1, Alt Bilgi 2, Alt Bilgi 3 (üç alt bilgi sütunu)

## 🔌 Önerilen Eklentiler

Aşağıdaki eklentiler Composer aracılığıyla dahil edilmiştir:

### Performans
- **Redis Cache**: Nesne önbellekleme için
- **WP Super Cache**: Sayfa önbellekleme için

### SEO
- **Yoast SEO**: Kapsamlı SEO optimizasyonu

### Güvenlik
- **Wordfence**: Web uygulaması güvenlik duvarı ve güvenlik tarayıcısı

### İşlevsellik
- **Contact Form 7**: İletişim formları
- **Elementor**: Sayfa oluşturucu (isteğe bağlı)

## ⚡ Performans Optimizasyonları

### Yerleşik Optimizasyonlar
- Lazy loading (gecikmeli yükleme) görseller
- Gzip sıkıştırma (Nginx)
- Tarayıcı önbellekleme
- Minified (küçültülmüş) varlıklar
- Devre dışı emoji scriptleri
- Kaldırılmış jQuery migrate
- Redis nesne önbellekleme
- Güvenlik başlıkları

## 🔒 Güvenlik

### Yerleşik Güvenlik Özellikleri
- Güvenlik başlıkları (X-Frame-Options, X-XSS-Protection, vb.)
- Devre dışı XML-RPC
- Script/stil'lerden kaldırılmış sürüm numaraları
- Dosya izinleri en iyi uygulamaları
- Wordfence web uygulaması güvenlik duvarı

## 🚢 Dağıtım

Üretim dağıtımı için detaylı talimatlar için [DEPLOYMENT.md](DEPLOYMENT.md) dosyasına bakın.

## 🆘 Sorun Giderme

### Site yavaş
1. Redis önbelleğini etkinleştirin
2. WP Super Cache'i etkinleştirin
3. Görselleri optimize edin
4. Eklenti çakışmalarını kontrol edin
5. wp-config.php'de PHP bellek sınırını artırın

### Beyaz ekran / 500 hatası
1. PHP hata günlüklerini kontrol edin
2. wp-config.php'de WordPress debug modunu etkinleştirin
3. Dosya izinlerini kontrol edin (dizinler için 755, dosyalar için 644)
4. Tüm eklentileri devre dışı bırakın
5. Varsayılan temaya geçin

## 📞 Destek

Sorunlar veya sorular için:
1. Yukarıdaki belgeleri kontrol edin
2. GitHub'da mevcut sorunları arayın
3. Geliştirme ekibiyle iletişime geçin

## 📄 Lisans

GPL-2.0-or-later

---

## English Version

# Optimed Hospital - Modern WordPress Site

Modern, fast, and responsive WordPress site for Optimed Hospital with performance optimizations and contemporary design.

## 🚀 Features

- **Modern Design**: Clean, professional healthcare-focused design
- **Fast Performance**: Optimized for speed with lazy loading, caching, and minification
- **Responsive**: Mobile-first design that works on all devices
- **SEO Optimized**: Built-in SEO best practices and WordPress SEO plugin
- **Secure**: Security headers, Wordfence, and security best practices
- **Docker Support**: Easy local development with Docker
- **Redis Caching**: Built-in Redis support for faster page loads
- **Modern Theme**: Custom-built theme with performance in mind
- **Accessibility**: WCAG compliant and keyboard-friendly

## 📋 Requirements

- Docker & Docker Compose (recommended)
- OR PHP 8.1+ with MySQL 8.0+ and Nginx/Apache

## 🛠️ Installation

See [QUICKSTART.md](QUICKSTART.md) for a detailed quick start guide.

Quick steps:
```bash
git clone <repository-url>
cd optimed-site-int
chmod +x setup.sh
./setup.sh
```

Visit http://localhost:8080 and complete WordPress installation.

## 📚 Documentation

- [QUICKSTART.md](QUICKSTART.md) - Quick start guide for getting up and running fast
- [DEPLOYMENT.md](DEPLOYMENT.md) - Detailed production deployment guide
- [README.md](README.md) - This file, overview and general documentation

## 🎯 Quick Commands

```bash
# Start the site
docker compose up -d

# Stop the site
docker compose down

# View logs
docker compose logs -f

# Run maintenance tasks
./maintenance.sh

# Backup database
./maintenance.sh  # Then select option 7
```

## ⚡ Performance

The site is built with performance in mind:
- Lazy loading images
- Redis object caching
- Page caching with WP Super Cache
- Minified CSS/JS
- Optimized database queries
- CDN-ready

## 🔒 Security

Built-in security features:
- Wordfence Web Application Firewall
- Security headers
- Disabled XML-RPC
- File integrity monitoring
- Strong password enforcement
- Regular security updates

## 📞 Support

- Check [QUICKSTART.md](QUICKSTART.md) for common questions
- See [DEPLOYMENT.md](DEPLOYMENT.md) for deployment help
- Contact development team for issues

## 📄 License

GPL-2.0-or-later

---

**Version**: 1.0.0  
**Last Updated**: December 2024  
**Maintained by**: Optimed Hospital Development Team
