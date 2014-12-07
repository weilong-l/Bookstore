use proj;


-- ----------------
--    Queries
-- ----------------

-- Q1
insert into customers(fullname,acc,password,credit_card,addr,phone)
values('Amy','Amy1','1234567','4248354200015666','BLK6 DOVER','90879876');

-- Q2
insert into orders(order_index,book,customer,copy,date,status)
SELECT 1 + coalesce((SELECT max(order_index) FROM orders WHERE customer='ANNA1'), 0),
'978-0321651525','ANNA1',2,  CURRENT_DATE(),'transferring';

update books
set copies=copies+2
where ISBN='978-0321651525';

select * from orders;

-- Q3
select * from customers where acc='ANNA1';
select * from orders where customer ='ANNA1';
select * from feedback where author='ANNA1';
select * from usefulness where reviewer ='ANNA1';

-- Q4
insert into books(ISBN, title, authors, publisher, year, copies, price, format, keywords, subject)
values('978-0321474049', 'The Digital Photography Book', 'Scott Kelby', 'Peachpit Press', 
        2006, 100, 25.5, 'paperback', 'digital, photography', 'phototography');
        
-- Q5
-- the manager input ISBN and no. of new copies 
update books
set copies = copies + 30
where ISBN = '978-0321474049';

-- Q6 (The score is initialised as 0 when the record is inserted)
insert into feedback(author, opinion, book,score,date)
values('ANNA1','it is a good book','978-0393317559',0.0,'09/08/2013');

-- Q7
insert into usefulness(author,book,reviewer,usefulness)
values('ANNA1','978-0393317558','BOB1',2);

update usefulness 
set usefulness=0
where author='BOB1' and reviewer='ANNA1';

select * from usefulness;
delete from usefulness where author='BOB1';

update feedback
set usefulness = (select avg(usefulness) from usefulness group by book,author having
feedback.book='978-0393317558' and author='BOB1')
where feedback.book='978-0393317558' and author='BOB1';
-- select * from feedback;
-- delete from feedback where author='BOB1';


-- Q8 (????)
-- sort by avg score
select ISBN,title, authors,publisher,year,price, subject, avg(score)  from
(select ISBN,title, authors,publisher,year,price, subject, score from books left outer join feedback
on books.ISBN=feedback.book ) search_book
where (authors like '%Jared M%' and publisher like'%%' and title like'%%' and subject like '%%')
group by ISBN
order by avg(score) desc;

-- sort by year
select ISBN,title, authors,publisher,year,price, subject, avg(score)  from
(select ISBN,title, authors,publisher,year,price, subject, score from books left outer join feedback
on books.ISBN=feedback.book ) search_book
where (authors like '%Jared M%' or publisher like'%prentice%' or title like'%Globalization%' or subject like '%sci-fi%')
group by ISBN
order by year desc;

-- no user-input
select ISBN,title, authors,publisher,year,price, subject, avg(score)  from
(select ISBN,title, authors,publisher,year,price, subject, score from books left outer join feedback
on books.ISBN=feedback.book ) search_book
group by ISBN
order by year desc;

 -- or (publisher like '%Company%') or (title like'%Guns%') or (subject like '%art%')

-- Q9
select * from feedback where book='978-0393317558' 
order by usefulness desc limit 1;


-- Q10
-- Assume a customer order a book '978-0321474049'
select book, count(book) from
	(select book from orders
	where customer in(
		select customer from orders
		where book = '978-0321474049')
	and book <> '978-0321474049') other_book
group by book
order by count(book) desc;


-- Q11

-- 1) 
-- m=1
select book, sum(copy) from orders
where date >= '2013-08-01' and date<'2013-08-31'
group by book
order by sum(copy) desc
limit 1;

-- 2)
select authors, sum(copy) from books, orders 
where books.ISBN = orders.book
and orders.date >= '2013-08-01' and orders.date<'2013-08-31'
group by authors
order by sum(copy)
limit 1;

-- 3)
select publisher, sum(copy) from books, orders 
where books.ISBN = orders.book
and orders.date >= '2013-08-01' and orders.date<'2013-08-31'
group by publisher
order by sum(copy)
limit 1;








