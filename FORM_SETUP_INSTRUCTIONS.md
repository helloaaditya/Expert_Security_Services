# Form Email Setup Instructions - EmailJS

## Quick Setup Guide

Both the **Contact Form** and **Career Application Form** are now configured to send emails using EmailJS.

### Step 1: Update EmailJS Template Recipient Email

**IMPORTANT:** The recipient email address is configured in your EmailJS template dashboard, NOT in the code files.

1. **Login to EmailJS Dashboard:**
   - Go to https://dashboard.emailjs.com/
   - Login with your EmailJS account

2. **Navigate to Email Templates:**
   - Click on "Email Templates" in the left sidebar
   - Find and click on template ID: `template_pg9hym8`

3. **Update Recipient Email:**
   - In the template editor, find the "To Email" field (or recipient field)
   - Change from: `aadityakum123@gmail.com`
   - Change to: `info@expertsecurityservices.online`
   - **OR** if your template uses a variable, make sure it uses `{{to_email}}` and the default value is set to `info@expertsecurityservices.online`

4. **Save the Template:**
   - Click "Save" to update the template
   - The changes will take effect immediately

### Step 2: Verify EmailJS Service Configuration

1. **Check Email Service:**
   - Go to "Email Services" in the left sidebar
   - Verify service ID: `service_6wk9oz4` is properly configured
   - Ensure the email service is connected and active

2. **Test the Forms:**
   - Submit a test form from your website
   - Check `info@expertsecurityservices.online` inbox
   - Verify the email arrives with all form data

### Current Configuration

- **EmailJS Public Key:** `IKDrGj1qtCXYVicHZ`
- **Service ID:** `service_6wk9oz4`
- **Template ID:** `template_pg9hym8`
- **Target Email:** `info@expertsecurityservices.online` (to be updated in dashboard)

### Form Data Sent

**Contact Form sends:**
- Full Name
- Email Address
- Phone Number
- Subject/Service
- Message

**Career Form sends:**
- Full Name
- Email Address
- Phone Number
- Position Applied For
- Years of Experience
- Preferred Location
- Educational Qualification
- PSARA License Status
- Cover Letter
- Resume (file attachment note)

### How It Works

- **EmailJS Integration**: Forms use EmailJS SDK to send emails without a backend
- **Client-Side Only**: All form processing happens in the browser
- **Real-time Feedback**: Users see loading states and success/error messages
- **No Backend Required**: EmailJS handles email delivery

### Troubleshooting

**If emails still go to the old address:**
1. Clear browser cache and try again
2. Verify the template is saved in EmailJS dashboard
3. Check that the correct template ID is being used
4. Verify EmailJS service is active and has available quota

**If emails are not being sent:**
1. Check browser console for JavaScript errors
2. Verify EmailJS Public Key is correct
3. Verify Service ID and Template ID match your EmailJS dashboard
4. Check EmailJS service quota/limits
5. Verify the email service (Gmail, Outlook, etc.) is properly connected in EmailJS

### EmailJS Account Limits

- **Free Tier:** 200 emails per month
- **Paid Plans:** Starting from $15/month for more emails
- Check your usage at: https://dashboard.emailjs.com/admin/integration

---

**That's it!** Update the recipient email in your EmailJS template dashboard and your forms will start sending to `info@expertsecurityservices.online`. 🎉
