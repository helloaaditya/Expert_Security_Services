# Form Email Setup Instructions

## Quick Setup Guide

Both the **Contact Form** and **Career Application Form** are now configured to send emails directly to your inbox using FormSubmit.co - **NO BACKEND OR API NEEDED!**

### Step 1: Update Email Address

1. **Contact Form** (`contact.html`):
   - Find line with: `action="https://formsubmit.co/info@expertsecurity.com"`
   - Replace `info@expertsecurity.com` with your actual email address

2. **Career Form** (`career.html`):
   - Find line with: `action="https://formsubmit.co/info@expertsecurity.com"`
   - Replace `info@expertsecurity.com` with your actual email address

### Step 2: Update Success Redirect URL (Optional)

1. **Contact Form** (`contact.html`):
   - Find: `name="_next" value="https://yourwebsite.com/contact.html?success=true"`
   - Replace `https://yourwebsite.com` with your actual website URL

2. **Career Form** (`career.html`):
   - Find: `name="_next" value="https://yourwebsite.com/career.html?success=true"`
   - Replace `https://yourwebsite.com` with your actual website URL

### Step 3: Verify Your Email (First Time Only)

1. When you first submit a form, FormSubmit will send a verification email to your address
2. Click the verification link in that email
3. After verification, all future form submissions will be delivered directly to your inbox

### How It Works

- **No Backend Required**: FormSubmit.co handles everything
- **Free Tier**: 50 submissions per month (free)
- **Email Format**: Form submissions arrive as nicely formatted emails
- **File Attachments**: Career form resume uploads are included in the email
- **Spam Protection**: Built-in honeypot and optional CAPTCHA

### Email Configuration Options

You can customize the email by modifying these hidden fields in the forms:

- `_subject`: Email subject line
- `_template`: Email format (table, box, or basic)
- `_captcha`: Enable/disable CAPTCHA (currently disabled)
- `_next`: Redirect URL after successful submission

### Testing

1. Submit a test form from your website
2. Check your email inbox (and spam folder if needed)
3. Verify the email and test again
4. All future submissions will work automatically!

### Need More Submissions?

If you need more than 50 submissions per month, FormSubmit offers paid plans starting at $10/month.

---

**That's it!** Your forms are ready to send emails without any backend setup. 🎉
