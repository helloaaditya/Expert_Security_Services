# SEO Setup Guide for Expert Security Services

This guide explains the SEO files and configurations for the website.

## Files Created

### 1. sitemap.xml
- Contains all pages of the website
- Helps search engines discover and index all pages
- **Action Required**: Update the domain URL from `https://expertsecurityservices.in` to your actual domain
- Submit to Google Search Console and Bing Webmaster Tools

### 2. robots.txt
- Guides search engine crawlers
- Allows all pages to be crawled
- Points to sitemap location
- **Action Required**: Update the domain URL if different

### 3. .htaccess
- Apache server configuration
- URL rewriting (removes .html extension)
- Compression and caching
- Security headers
- **Note**: Only works on Apache servers. For Nginx, use nginx.conf

### 4. humans.txt
- Credits file for developers and technology stack
- Optional but good practice

## Setup Instructions

### Step 1: Update Domain URLs
1. Replace `https://expertsecurityservices.in` with your actual domain in:
   - `sitemap.xml`
   - `robots.txt`
   - All HTML files (canonical URLs and structured data)

### Step 2: Submit to Search Engines

#### Google Search Console
1. Go to https://search.google.com/search-console
2. Add your property (website)
3. Verify ownership (HTML file, DNS, or meta tag)
4. Submit sitemap: `https://yourdomain.com/sitemap.xml`

#### Bing Webmaster Tools
1. Go to https://www.bing.com/webmasters
2. Add your site
3. Verify ownership
4. Submit sitemap: `https://yourdomain.com/sitemap.xml`

### Step 3: Verify robots.txt
1. Visit: `https://yourdomain.com/robots.txt`
2. Ensure it's accessible and correct

### Step 4: Test Structured Data
1. Use Google's Rich Results Test: https://search.google.com/test/rich-results
2. Test your homepage URL
3. Fix any errors if found

### Step 5: Enable HTTPS (Recommended)
1. Install SSL certificate
2. Uncomment HTTPS redirect in `.htaccess`
3. Update all URLs to use HTTPS

## SEO Best Practices Implemented

✅ **Meta Tags**: Title, description, keywords, Open Graph
✅ **Structured Data**: JSON-LD for Organization and LocalBusiness
✅ **Canonical URLs**: Prevent duplicate content
✅ **Sitemap**: All pages listed with priorities
✅ **Robots.txt**: Proper crawler instructions
✅ **Mobile Responsive**: All pages mobile-friendly
✅ **Fast Loading**: Optimized images and code
✅ **Security Headers**: X-Frame-Options, X-XSS-Protection, etc.

## Additional Recommendations

1. **Create 404.html**: Custom error page
2. **Add Analytics**: Google Analytics or similar
3. **Social Media**: Add social media links and Open Graph images
4. **Local SEO**: Add Google My Business listing
5. **Backlinks**: Build quality backlinks from relevant sites
6. **Content Updates**: Regularly update content and sitemap dates
7. **Page Speed**: Optimize images and minimize CSS/JS
8. **Internal Linking**: Link related pages together

## Monitoring

- **Google Search Console**: Monitor search performance
- **Google Analytics**: Track visitor behavior
- **PageSpeed Insights**: Check page speed
- **Mobile-Friendly Test**: Ensure mobile compatibility

## Notes

- Update `lastmod` dates in sitemap.xml when pages are updated
- Keep sitemap.xml updated when adding/removing pages
- Test .htaccess changes on staging before production
- Backup .htaccess before making changes
