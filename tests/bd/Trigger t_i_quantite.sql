select idproduit, stock
from produit
where idproduit = 21;

insert into quantite
values(21, 1, 4, 10);

select idproduit, stock
from produit
where idproduit = 21;

delete from quantite where idproduit = 21 and idcommande = 1;

update produit set stock = 5 where idproduit = 21;

rollback;
commit;