document.addEventListener("DOMContentLoaded", function () {
              const form = document.querySelector(".booking-form");
          
              form.addEventListener("submit", function (event) {
                  event.preventDefault(); 
          
               
                  const name = form.querySelector("input[type='text']").value.trim();
                  const phone = form.querySelector("input[type='tel']").value.trim();
                  const email = form.querySelector("input[type='email']").value.trim();
                  const service = form.querySelector("select").value;
          
                  if (name === "" || phone === "" || email === "" || service === "نوع الخدمة المطلوبة") {
                      alert("يرجى ملء جميع الحقول المطلوبة.");
                      return;
                  }
          
                  const phonePattern = /^[0-9]{10,15}$/;
                  if (!phonePattern.test(phone)) {
                      alert("يرجى إدخال رقم جوال صالح مكون من 10 إلى 15 رقماً.");
                      return;
                  }
          
                  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                  if (!emailPattern.test(email)) {
                      alert("يرجى إدخال بريد إلكتروني صحيح.");
                      return;
                  }
          
                 
                  alert(`تم حجز موعد الصيانة بنجاح!\nالاسم: ${name}\nرقم الجوال: ${phone}\nالخدمة: ${service}`);
          
                  form.reset();
              });
          });
          document.addEventListener("DOMContentLoaded", function () {
              const form = document.querySelector(".auth-form form");
          
              form.addEventListener("submit", function (event) {
                  event.preventDefault(); // منع الإرسال الافتراضي للنموذج
          
                  // جلب القيم المدخلة
                  const email = document.getElementById("email").value.trim();
                  const password = document.getElementById("password").value.trim();
          
                  // التحقق من إدخال البيانات
                  if (email === "" || password === "") {
                      alert("يرجى ملء جميع الحقول المطلوبة.");
                      return;
                  }
          
                  // التحقق من صحة البريد الإلكتروني
                  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                  if (!emailPattern.test(email)) {
                      alert("يرجى إدخال بريد إلكتروني صحيح.");
                      return;
                  }
          
                  // التحقق من طول كلمة المرور
                  if (password.length < 6) {
                      alert("يجب أن تكون كلمة المرور مكونة من 6 أحرف على الأقل.");
                      return;
                  }
          
                  // رسالة نجاح تسجيل الدخول (يمكنك استبدالها بنقل المستخدم لصفحة أخرى)
                  alert("تم تسجيل الدخول بنجاح!");
                  window.location.href = "dashboard.html"; // تحويل المستخدم إلى صفحة رئيسية بعد تسجيل الدخول
              });
          });
                    