<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pet Approval Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f2f4f6; font-family: 'Segoe UI', sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f2f4f6; padding: 40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
          <!-- Header -->
          <tr style="background-color: #14b8a6;">
            <td align="center" style="padding: 30px 20px;">
              <h1 style="color: #ffffff; margin: 0; font-size: 26px;">PetAdoption</h1>
              <p style="color: #e0f7f5; font-size: 16px; margin: 5px 0 0;">Helping paws find loving homes 🐾</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding: 40px 30px; color: #333333;">
              <h2 style="font-size: 22px; color: #14b8a6; margin-bottom: 20px;">Hello {{ $pet->user->name }},</h2>
              <p style="font-size: 16px; line-height: 1.6; margin: 0 0 15px;">
                🎉 We have some exciting news! Your pet <strong>{{ $pet->name }}</strong> has been <strong>approved</strong> by our admin team.
              </p>
              <p style="font-size: 16px; line-height: 1.6; margin: 0 0 15px;">
                It's now listed on our platform and is visible to potential adopters looking for their new furry friend. 🏡
              </p>
              <p style="font-size: 16px; line-height: 1.6; margin: 0 0 25px;">
                Thank you for choosing PetAdoption and being a hero in a pet’s journey to finding a loving home. 🐶🐱
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 30px; background-color: #f9fafb; text-align: center; color: #777777; font-size: 14px;">
              <p style="margin: 0;">With love,</p>
              <p style="font-weight: bold; margin: 5px 0;">Pet Adoption System Team</p>
              <p style="font-size: 12px; margin: 10px 0 0;">🐾 Connecting pets with their forever homes.</p>
              <p style="font-size: 12px; margin: 5px 0 0;">© {{ date('Y') }} PetAdoption. All rights reserved.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
