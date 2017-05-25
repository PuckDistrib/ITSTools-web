<html>
 <?php include 'header.md'; ?>


        <h2>Benchmark experimentations for LTL model checking.</h2>
	<p> This page reports on experiments performed using the its-ltl tool on two benchmarks: the [BEEM benchmark</a>, and some <a href="http://www.cs.ucr.edu/~ciardo/pubs/1999ICATPN-MDD.pdf">classic Petri net</a> benchmark models. This page is meant to complement our <a href="files/TechReport.pdf">technical report](http://anna.fi.muni.cz/models/)  with additional information, experimental data and the procedure to reproduce these results.</p>
	<p>The input models and LTL formulae are available as compressed archives:</p>
		<ul>
		  <li> BEEM models in [ETF format</a> as produced by <a href="http://fmt.cs.utwente.nl/tools/ltsmin/">LTSmin</a> invoked with option "-gs" (group safely): <a href="files/BEEM_etf.tar.bz2">BEEM_etf.tar.bz2 (17 MB)](http://fmt.cs.utwente.nl/tools/ltsmin/etf.html). The formulae were manually transcribed from description provided in BEEM. Models we treated from this benchmark are all those for which LTL formulae are defined: at, bakery, bopdp, brp, driving_phils, elevator, elevator2, extinction, fischer, iprotocol, lamport, lamport_nonatomic, lann, leader_election, leader_filters, lifts, loyd, lup, mcs, peterson, pgm_protocol, phils, plc, production_cell, protocols, public_subscribe, rether, synapse and szymanski. All "remarkable instances" (various values for the parameters such as the number of process, or the presence/absence of a deliberate error) of these models as defined by BEEM were treated; in total 164 different model instances constitute this benchmark set. We input both the formulae provided by BEEM and their negation to provide a better sample of both verified and unverified formulae, for a total of 822 LTL formulae defined. We also artificially built a total of 600 formulae with the next X LTL operator (hence not necessarily stuttering invariant) using atomic propositions from the set used in the formulae of BEEM.</li>
		  <li> Petri net models [nets.tar.bz2</a> in PROD format taken from Ciardo's Smart test bench <a href="http://www.cs.ucr.edu/~ciardo/pubs/1999ICATPN-MDD.pdf">(see ICATPN'99 paper)</a>, to which we associated 100 random LTL formulae produced by <a href="http://spot.lip6.fr/">Spot's randltl](files/nets.tar.bz2) tool. These are 4 classic scaleable examples which were treated for (relatively to the values that can be used for reachability) rather low parameter values of N. The models are Slotted Ring, Flexible Manufacturing System and Kanban for N=5 and N=10, and Dining Philosophers for N=5, N=10, N=50 and N=100. All these Petri net examples were tackled in two "flavors", the "_nm" (for "no modules") version which defines no hierarchy (i.e. we run mostly on DDD) and the "normal" version that defines modules (treated as ITS subcomponents). The "_nm" examples scale much more poorly since they cannot benefit from SDD hierarchy. In total, this benchmark defines 2040 stuttering invariant experiments and 2000 experiments with the next operator.</li> 
		</ul>
	<p>The raw data corresponding to runs of these input problems was collected on a 24 processor, 128Gb RAM, 64 bit arch, linux machine. Experiments reported do not use any kind of multi-threading, although they were run in parallel since the machine allows this. The raw results are available as compressed archives : [full_logs.tar.bz2 (500 KB)](files/full_logs.tar.bz2). These log files are formatted as CSV tables, allowing easy analysis with both scripts and spreadsheets such as Excel/OOffice.</p>
	<p>The plots of the TR were built from these raw results using gnuplot and some shell and Perl scripts. See the bottom of this page for more information on how to use these scripts and reproduce our experiments.</p>
	<p>We compare here several algorithms for checking the satisfaction of LTL formulae. </p>
		<ul>
		  <li>SOG : the Symbolic Observation Graph (see [Design and evaluation of a symbolic and abstraction-based model checker, ATVA05</a> and <a href="https://projets-systeme.lip6.fr/trac/research/libddd/export/1768/sog-its/trunk/doc/positionnement/articles/icatpn08.pdf" >MC-SOG: An LTL model checker based on symbolic observation graphs, ATPN'08](http://www.lsv.ens-cachan.fr/Publis/PAPERS/PDF/HIK-atva04.pdf)). This is an aggregated representation of the Kripke structure that preserves stuttering invariant LTL properties. It's complexity tends to increase with the number of atomic propositions in the formula, but for typical formulae it can be very efficient. </li>
		  <li>SOP : the Symbolic Observation Product. This is an aggregated synchronized product adapted to verification of stuttering invariant properties. It builds upon the ideas of SOG, but the observed alphabet is reduced as the product progresses, yielding overall better results than SOG. (We sometimes name this graph DSOG for historical reasons)</li>
		  <li>SLAP : the Symbolic Local Aggregation Product. This aggregated synchronized product uses an aggregation condition based on a structural analysis of self-loops on states of the formula TGBA. It is not limited to stuttering invariant properties.</li>
		  <li>FSOWCTY : Fully Symbolic LTL. This is an implementation of the OWCTY forward (One Way Catch Them Young) algorithm for symbolic LTL model-checking. It builds a system by composing the TGBA and the ITS system description, then explores this product symbolically. This variant only uses the forward transition relation to compute SCC hulls (i.e. in this forward case the SCCs and their suffixes are computed) rather than exactly compute the SCCs. </li>
		  <li>FSEL : Fully Symbolic LTL. This is an implementation of the Emerson and Lei fully symbolic algorithm. This variant only uses the forward transition relation to compute SCC hulls (i.e. in this forward case the SCCs and their suffixes are computed) rather than exactly compute the SCCs. </li>
		  </ul>
	<p> Do note that SOG, SOP and SLAP are hybrid algorithms, where the emptiness check is performed explicitly (by [Spot](http://spot.lip6.fr/)), but states are actually aggregates of system states stored as SDD. A contrario, FSLTL is fully symbolic, and only relies on Spot to build the TGBA representation of the formula.</p>


		<h2> Reproducing this benchmark </h2>
	<p>The raw data corresponding to runs of these input problems was collected on a 24 processor, 128Gb RAM, 64 bit arch, linux machine. Experiments reported do not use any kind of multi-threading, although they were run in parallel since the machine allows this. The raw results are available as compressed archives : [full_logs.tar.bz2 (500 KB)](files/full_logs.tar.bz2). These log files are formatted as CSV tables, allowing easy analysis with both scripts and spreadsheets such as Excel/OOffice.</p>
	<p>With the default timeout at 120 seconds, running the full set of experiments should take a reasonale amount of time even with only one or two parrallel runs, i.e. it runs overnight more or less. Running the full bench with 10000 seconds timeout took us about 50 hours while running 20 experiments in parallel. </p>
		<p>
		To reproduce this benchmark, apply the following steps :
		<ol>
		  <li>Obtain the its-ltl tool, either from anonymous svn or from the pre-built binary appropriate for your platform. See [download page</a> for details. We recommend you take the binary if available, as otherwise you will need to install <a href="http://spot.lip6.fr/">Spot](download.html) as well as resolve some other dependencies. </li>
		  <li>(Skip this step if you rebuilt its-ltl from svn at step 1, you already have this folder). If you opted for the binary, in an empty folder, let's say "its-ltl/", checkout the "its-ltl" samples folder from svn, that contains all the appropriate input and helper scripts. "svn co --username anonymous --password anonymous https://projets-systeme.lip6.fr/svn/research/libddd/sog-its/trunk/samples ./samples". Build a folder "its-ltl/src" and place the its-ltl executable there (or edit the top of script "bench2.pl" to have variable "$default_checksog" point the appropriate location). </li>
		  <li> (Optional) Build the ETF files from the DVE input models. For this, first download and install [LTSmin</a> and its DiVine dependencies. Then download the <a href="http://anna.fi.muni.cz/models/models_data.tar.gz">BEEM benchmark examples](http://fmt.cs.utwente.nl/tools/ltsmin/). We used LTSmin by invoking "dve-reach -gs --vset=list --order=chain input.dve output.dve.etf" for each input model in "*/generated_files/*.dve". Note the ETF files we built are already provided in the samples/BEEM folder in an archive. Decompress this file to obtain them :"tar xvjf etf-models.tar.bz2".</li>
		  <li> Decompress the archive in folder samples/BEEM : "tar xvjf etf-models.tar.bz2". This file contains both formulae and ETF models we built using LTSmin. If you prefer, you can overwrite the ETF files from the archive with your own versions built at step 2. </li>
		  <li> Run the script "genmk_etf.sh BEEM" on the BEEM folder containing your .etf and .ltl files. This shell script will build a Makefile called "BEEM.mk". Before running this shell script, you can change the value for the timeout "-t 120" to some other value. Be aware that the longer a process runs, the higher the chance of it needing lots of memory. On the experiments reported above with 10000 seconds timeout some runs used up to 12 GB of RAM. </li>
		  <li> Run "make -j -f BEEM.mk". This will run the actual benchmark. The "-j" option means use as many CPU as there are on the machine. You may want to limit this to just a few parrallel runs, e.g. "-j2" will only run two experiments simultaneously. </li>
		  <li> For Petri net models, we used the models in the "samples/test_bench/" folder. Similarly to above, run "genmk.sh test_bench", then "make -f test_bench.mk" to run these tests.
		</ol>

		<p>The data will be collected in files with extension ".log". The perl and shell scripts in the samples/ folder help to analyze them. 
		For instance, run "plot_all.sh BEEM" then build the latex file perfs.pdf "latex perfs.tex ; dvipdf perfs.dvi". Script "plot_all.sh" shows how to invoke the gnuplot scripts. You can also get some global statistics by invoking "sum_all.sh BEEM". This analysis can also be performed on the log files we collected [full_logs.tar.bz2 (500 KB)](files/full_logs.tar.bz2). </p>

<!-- #EndEditable -->
<?php include 'footer.md'; ?>
</html>
        