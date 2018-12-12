echo "<br>"
echo "******************** Reiniciando Sistema de Busca SWDB ********************<br>"
echo "<br>"
echo "<br>"

sudo service elasticsearch stop
echo "<br>"
echo "<br>"

sudo service elasticsearch status
echo "<br>"
echo "<br>"

sudo service elasticsearch start
echo "<br>"
echo "<br>"

sudo service elasticsearch status

echo "<br>"
echo "<br>"
echo "***************************************************************<br>"
echo "<br>"

echo "********************* 2 Minutos em Produção **********************<br>"
echo "<br>"
