Game = function(){
	this.myCards = [];
	this.myCardsResponse = [];
	this.countOfPlayers = 10;
	this.myPosition = 1;
	this.cards = {
		"Ղառ":["A","2","3","4","5","6","7","8","9","T","J","Q","K","A"],
		"Խաչ":["A","2","3","4","5","6","7","8","9","T","J","Q","K","A"],
		"Քյափ":["A","2","3","4","5","6","7","8","9","T","J","Q","K","A"],
		"Սիրտ":["A","2","3","4","5","6","7","8","9","T","J","Q","K","A"]
	};
	
	this.init = function(){
		var div = "<table>"; 
		for(key in this.cards){
			div = div + "<tr>"; 
			for(key2 in this.cards[key]){
				div = div + "<td><a class='card "+key+"' onclick='resetGame.clickCard(\""+this.cards[key][key2]+"\",\""+key+"\")'>"+key+" "+this.cards[key][key2]+"</a></td>";
			}
			div = div + "</tr>"; 
		}
		div = div + "</table>";
		$("#cardDiv").html(div);
		$("#result").html("");
		$("#playersCount").val(10);
		$("#position").val(1);
		$("#type2").val("");
		$("#type1").val("");
	};
	
	this.resetCards = function(){
		
		$("#result").html("");
		$("#type2").val("");
		$("#type1").val("");
		this.myCards = [];
		this.myCardsResponse = [];
	};
	
	this.clickCard = function(card,mast){
		if(resetGame.myCards.length == 0){
			resetGame.myCards[0] = [card,mast];
			$("#type1").val(mast + "ի " + card);
		}else if((resetGame.myCards.length==1 || resetGame.myCards.length==2) ){
			if(resetGame.myCards[0][1]==mast && resetGame.myCards[0][0]!=card){
				resetGame.myCardsResponse = resetGame.myCards[0][0]+card+"s";
				$("#type2").val(mast + "ի " + card);
				resetGame.analaize();
			}else if(resetGame.myCards[0][1]!=mast){
				resetGame.myCardsResponse = resetGame.myCards[0][0]+card;
				$("#type2").val(mast + "ի " + card);
				resetGame.analaize();
			}
			
		}
	};
	
	this.calculate = function(){
		resetGame.analaize();
	}
	
	this.analizePosition = function(key){
		differenceFromFullTable = 10-resetGame.countOfPlayers;console.log(resetGame.countOfPlayers,resetGame.myPosition,differenceFromFullTable,resetGame.countOfPlayers-resetGame.myPosition + differenceFromFullTable)
		switch(resetGame.myPosition){
			case 9:
				if(key>=0 && key<5){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-4 մակարդակներին (ձեր մակարդակն է "+parseInt(parseInt(key)+1)+"): Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 5 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2 մակարդակներով(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+")<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 8:
				if(key>=0 && key<5){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-4 մակարդակներին(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+"): Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 5 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2 (ձեր մակարդակն է "+parseInt(parseInt(key)+1)+")մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 7:
				if(key>=0 && key<5){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-4 (ձեր մակարդակն է "+parseInt(parseInt(key)+1)+")մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 5 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավլացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 6:
				if(key>=0 && key<6){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-5(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 6 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 5:
				if(key>=0 && key<6){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-5(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 6 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 4:
				if(key>=0 && key<6){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-5(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 6 մակարդակի քարերով սպասելով ֆլոպին լավ քարի<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1, 2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 3:
				if(key>=0 && key<9){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-7(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 8 մակարդակի քարերով սպասելով ֆլոպին լավ քարի:Ամբողջ տարբերությունը նրանումա որ դուք մոտավոր արդեն պետքա որ պատկերացնեք ինչ ունեն հակառակորդները իրենց ստավկաներից.<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1,2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 2:
				if(key>=0 && key<9){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-7(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 8 մակարդակի քարերով սպասելով ֆլոպին լավ քարի:Ամբողջ տարբերությունը նրանումա որ դուք մոտավոր արդեն պետքա որ պատկերացնեք ինչ ունեն հակառակորդները իրենց ստավկաներից.<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1,2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			case 1:
				if(key>=0 && key<9){
					$("#result").append("2. Դուք կարող եք խաղալ այս դիրքից եթե ձեր քարերը պատկանում են 1-7(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներին: Եթե խաղը շատ ագրեսիվ չի ընթանում կարող եք խաղալ նաև 8 մակարդակի քարերով սպասելով ֆլոպին լավ քարի:Ամբողջ տարբերությունը նրանումա որ դուք մոտավոր արդեն պետքա որ պատկերացնեք ինչ ունեն հակառակորդները իրենց ստավկաներից.<br>");
					$("#result").append("3. Եթե ձեր ավելացնելուց հետո նորից ավելացրել են խաղացեք միայն 1,2(ձեր մակարդակն է "+parseInt(parseInt(key)+1)+") մակարդակներով<br>");
				}else{
					$("#result").append("Այս դիրքից խաղալը վտանգավոր է "+parseInt(parseInt(key)+1)+" մակարդակի քարերով");
				}
				break
			default:
				$("#result").append("Սխալ մուտքեր դիրքի վերաբերյալ");
		}
		$("#result").append("<H3>Եթե խաղում եք մրցաշար մի վռազեք օգտագործել ամբեղջ բանկը</H3>");
	};
	
	this.analaize = function(){
		if(typeof resetGame.myCardsResponse)
		$("#result").html("Ձեր խաղաքարտերն են "+resetGame.myCardsResponse+" <br>");
		for(key in BestPreflops){
			preflop = BestPreflops[key];
			console.log(typeof preflop);
			for(key2 in preflop){
				if(preflop[key2] == resetGame.myCardsResponse){
					$("#result").append("1. Ձեր խաղաքարերի մակարդակն է " + parseInt(parseInt(key)+1) + " " + "<br>" + AccordingToBestFlops[key] + "<br>");
					resetGame.analizePosition(key);
					return true;
				}
			}
		}
		$("#result").append("Ձեր խաղաքարերի մակարդակն է 9 "+"<br>"+AccordingToBestFlops[8]);
		return false;
	};
	
	
}