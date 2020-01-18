//select users depending on assermentation

select U.Image Image, U.Nom Nom, U.Prenom Prenom
from utilisateur U
JOIN traducteurdata TD
ON U.Id = TD.TraducteurId
WHERE TD.Assermetation_doc is ?

//selectionner users et leurs langues

select U.id, L.Nom
from utilisateur U
JOIN maitriselangue ML
ON U.Id = ML.TraducteurId
JOIN langue L
ON L.Id = ML.LangueId

//selectionner users et leurs types maitrisées

select U.id, MT.Type
from utilisateur U
JOIN maitrisetype MT
ON U.Id = MT.TraducteurId

//selectionner users et leurs notes

    select U.id, 
    CASE
    when AVG(N.valeur) is NULL then 0
    when AVG(N.valeur) is not null then AVG(N.valeur)
    END as note
    from utilisateur U
    LEfT Join note N
    On U.Id = N.TraducteurId
    group by u.Id

//selectionner nombre de traduction par traducteur

select u.id, COUNT(tf.Id) nbr
from utilisateur u
LEFT join demandet_accepte da
on u.Id = da.TraducteurId
left join traduction_debutee td
on td.DemandeId = da.Id
left join traduction_finie tf
on tf.TraductionId = td.Id
group by u.id

