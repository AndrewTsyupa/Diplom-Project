# Diplom-Project
Diplom-Project of Andrew Tsyupa for KEP IFNTUNG (Nov 2018)
## Student Info
* Name: Andrii Tsyupa
* University: КЕП ІФНТУНГ
* Course: //todo: 4 Курс 
## Task Info
  Website of Software Management   
  ![Зображенн Файлового менеджера ](https://github.com/AndrewTsyupa/img/raw/master/11.PNG) 
## Функціонал настільного додатку  
Розроблено настільний додаток для роботи з файловою системою. Юзер  має можливість
  обрати в програмі каталог для роботи. Після вибору каталгу додаток виконує рекурсивне
  відскановування усіх файлів в каталозі та його підкаталогах і виведе наступну інформацію:
* Загальна кількість файлів в каталогу.
* Загальний об’єм файлів.
* Список файлів, які були останній раз модифіковані більше двох тижнів тому.
* Часовий проміжок для користувач задає власноруч в виділені поля
## Збереження видалених даних
Користувач має можливість в програмі відмітити файли зі списку, згаданого раніше, та
видалити їх.
Історія видалень зберігатися в окремому файлі : XML
Історія повинна містити:
* Час зміни.
* Список видалених файлів.
* Особу, яка здійснила видалення (Windows Account).