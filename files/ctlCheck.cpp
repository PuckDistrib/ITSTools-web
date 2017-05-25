#include "mc/ctlCheck.hh"
#include "ctlp/visfd.h"

using namespace its;


its::Transition  CTLChecker::getHomomorphism (Ctlp_Formula_t *ctlFormula) const {
  return Transition::id;
}


// Explain the truth value of formula in given states.
// Formula is true if at least some input states satify it.
// Writes to out a diagnosis.
// Returns states that were actually explained, a subset of the input states.
its::State CTLChecker::explain (its::State sat, Ctlp_Formula_t *ctlFormula, std::ostream & out) const  {
 
  out << "Subformula :";
  Ctlp_FormulaPrint(vis_stdout, ctlFormula);
  // test if formula is true in given states. i.e. some at least satisfy p.
  its::State trueF = getStateVerifying(ctlFormula);
  // Testing with subsets would be stronger, requiring all states satisfy p.
  its::State satF = sat * trueF ; 
  bool formIsTrue = ( satF != State::null ) ;
  if (trueF != State::one) {
    if (formIsTrue) {
      out << " is true in ";
      if (sat.nbStates()==1) {
	out << "the single input state :\n" ;
	model.printSomeStates(sat,out);
      } else {
	out << satF.nbStates() <<  " state(s) out of "<< sat.nbStates() << " input state(s).\n";
      }
    } else {
      out << " is false in all " << sat.nbStates() << " input state(s).\n"  ;
    }
  } // End of Forward CTL State::one case.
  // Handle left child
  Ctlp_Formula_t *leftChild = Ctlp_FormulaReadLeftChild(ctlFormula);
  // Handle right child
  Ctlp_Formula_t *rightChild = Ctlp_FormulaReadRightChild(ctlFormula);

  
  // Now switch on the type of formula
  switch (Ctlp_FormulaReadType(ctlFormula)) {
  case Ctlp_ID_c:
      {
	if (formIsTrue) {
	  if (satF.nbStates() > 1) {
	    out << "For instance predicate is true in these states :\n";
	    model.printSomeStates(satF, out);
	  }
	  return satF;
	} else {
	  out << "Because atomic predicate " << Ctlp_FormulaReadVariableName(ctlFormula) << Ctlp_FormulaReadValueName(ctlFormula) << " is false in all " << sat.nbStates()  << " input states. \n" <<  std::endl ;
	  out << "For instance predicate is false in this state :\n";
	  model.printSomeStates(sat, out);
	  return sat;
	}
	break;
      }
  case Ctlp_TRUE_c:
    out << "Because TRUE holds true in any state.\n";
    return sat;
    break;
    
  case Ctlp_FALSE_c:
    out << "Because FALSE is false in any state.\n";
    return sat;
    break;
    
  case Ctlp_NOT_c:
    if (formIsTrue) {
      out << "Because for some input states all future behaviors satisfy NOT(" ;
      Ctlp_FormulaPrint(vis_stdout, leftChild);
      out << ")" <<  std::endl;
      return explain(satF, leftChild, out);
    } else {
      out << "Because for some input states, there exist some future behaviors that satisfy " ;
      Ctlp_FormulaPrint(vis_stdout, leftChild);
      out <<  std::endl;
      return explain(sat, leftChild, out);
    }
    break;
    
  case Ctlp_AND_c:
    if (formIsTrue) {
      out << "Because both " ;
      Ctlp_FormulaPrint(vis_stdout,leftChild);
      out  << " and " ;
      Ctlp_FormulaPrint(vis_stdout,rightChild);
      out << " are satisfied in some input states. For instance :\n" ;
      its::State lexpl = explain(satF, leftChild, out); 
      out << "And in the same states  \n";
      its::State rexpl = explain(lexpl, rightChild, out); 
      return rexpl;
    } else {
      
      out << "Because no input states satisfy both " ;
      Ctlp_FormulaPrint(vis_stdout,leftChild) ;
      out << " and " ;
      Ctlp_FormulaPrint(vis_stdout,rightChild);
      out<< " simultaneously.\n" ;
      if (leftChild && rightChild) {
	its::State leftStates = getStateVerifying (leftChild) * sat ;
	its::State rightStates = getStateVerifying (rightChild) * sat ;
	
	// cut into cases, since a & b is false in s 
	// either : s*a = 0  or s*b = 0 (explain why) and its no use talking further
	// or both are non-empty but a&b false, so that (s*a) * (s*b) is empty.
	// explain both a and b and conclude in empty intersection.
	if (leftStates == its::State::null && rightStates == its::State::null) {
	  out << "Even formula " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << " OR " ;
	  Ctlp_FormulaPrint(vis_stdout,rightChild) ;
	  out << " is false in all input states.\n" ;
	  out << " For instance " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << " is not satisfied in input states.\n";
	  return explain(sat,leftChild,out);
	} else if (leftStates == its::State::null) {
	  out << "First conjunct  " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild) ;
	  out << " is not satisfied in any input states. So AND conjunction is false.\n";
	  return explain(sat,leftChild,out);
	} else if (rightStates == its::State::null) {
	  out << "Second conjunct  " ;
	  Ctlp_FormulaPrint(vis_stdout,rightChild) ;
	  out << " is not satisfied in any input states. So AND conjunction is false.\n";
	  return explain(sat,rightChild,out);
	} else {
	  out << "Some " << leftStates.nbStates() << " of your " << sat.nbStates() << " input states do satisfy " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << " AND some " << rightStates.nbStates() << " of your " << sat.nbStates() << " input states do satisfy " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << ".\nBut these sets (explained below) have an empty intersection.\n";
	  explain(sat, leftChild, out);
	  explain(sat, rightChild, out);
	  return sat;
	}
      } else {
	std::cerr << "ERROR : Conjunction has no children" << std::endl; 
	assert(false);
      }	
    }
    break;
    
  case Ctlp_EQ_c:
    assert(false);
    //      result = mdd_xnor(leftMdd, rightMdd); 
    break;
    
  case Ctlp_XOR_c:
    assert(false);
    //      result = mdd_xor(leftMdd, rightMdd); break;
    break;

  case Ctlp_THEN_c:
    // A => B    <->  not A or B
    if (formIsTrue) {
      if (leftChild && rightChild) {
	its::State leftStates = getStateVerifying (leftChild) * sat ;
	its::State rightStates = getStateVerifying (rightChild) * sat ;
	if (leftStates != its::State::null) {
	  out << "Because NOT " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << " is true in " << leftStates.nbStates() << " states of your " << sat.nbStates() << " input states." << std::endl;
	  return explain(leftStates, leftChild, out);
	} else {
	  out << "Because " ;
	  Ctlp_FormulaPrint(vis_stdout,rightChild);
	  out << " is true in " << rightStates.nbStates() << " states of your " << sat.nbStates() << " input states." << std::endl;
	  return explain(rightStates, leftChild, out);
	}
      } else {
	std::cerr << "ERROR : Implication has no children" << std::endl; 
	assert(false);
      }
    } else {
      out << "Because A=>B <==> !A OR B and  both NOT(" ;
      Ctlp_FormulaPrint(vis_stdout,leftChild);
      out  << ") and " ;
      Ctlp_FormulaPrint(vis_stdout,rightChild);
      out << " are unsatisfied in all input states. For instance A is true :\n" ;
      its::State lexpl = explain(sat, leftChild, out); 
      out << "And also (!B) is true \n";
      its::State rexpl = explain(sat, rightChild, out); 
      return sat;
    } 
    break;

  case Ctlp_OR_c:
    if (formIsTrue) {
      if (leftChild && rightChild) {
	its::State leftStates = getStateVerifying (leftChild) * sat ;
	its::State rightStates = getStateVerifying (rightChild) * sat ;
	if (leftStates != its::State::null) {
	  out << "Because " ;
	  Ctlp_FormulaPrint(vis_stdout,leftChild);
	  out << " is true in " << leftStates.nbStates() << " states of your " << sat.nbStates() << " input states." << std::endl;
	  return explain(leftStates, leftChild, out);
	} else {
	  out << "Because " ;
	  Ctlp_FormulaPrint(vis_stdout,rightChild);
	  out << " is true in " << rightStates.nbStates() << " states of your " << sat.nbStates() << " input states." << std::endl;
	  return explain(rightStates, leftChild, out);
	}
      } else {
	std::cerr << "ERROR : Implication has no children" << std::endl; 
	assert(false);
      }
    } else {
      out << "Because both A and B are unsatisfied in all input states. Both NOT(" ;
      Ctlp_FormulaPrint(vis_stdout,leftChild);
      out  << ") and NOT(" ;
      Ctlp_FormulaPrint(vis_stdout,rightChild);
      out << ") are true in all input states. For instance A is false :\n" ;
      its::State lexpl = explain(sat, leftChild, out); 
      out << "And also B is false \n";
      its::State rexpl = explain(sat, rightChild, out); 
      return sat;
    } 
    break;

  case Ctlp_EX_c:
    if (formIsTrue) {
      if (leftChild) {
	its::State leftStates = getStateVerifying (leftChild) ;
	its::path_t path = model.findPath(satF,leftStates, getReachable(), true);
	// EX => should be exactly one transition
	assert(path.getPath().size() == 1);
	out << "EX p is true Because there are immediate successors of input states that satisfy p.\n";
	out << "Following path leads from initial states to states satisfying p.\n";
	model.printPath(path,out,true);
	explain (path.getFinal(),leftChild,out);
	return path.getInit();
      } else {
	std::cerr << "ERROR : EX has no children" << std::endl; 
	assert(false);
      }
    } else {
      out << "EX p is false because all successors of current states satisfy !p.\n" ;
      out << "For instance some input states such as \n" ;
      model.printSomeStates(sat,out);
      out << " have successors such as  \n" ;
      explain ( getNextRel() (sat), leftChild, out);
      return sat;
    } 
    break;
  case Ctlp_EU_c: 
    {
      // start from states satisfying g, then add predescessors verifying f in a fixpoint.
      // f U g <-> ( f & pred + Id )^* & g
      //      result = fixpoint ( (leftStates * getPredRel()) + its::Transition::id )  (rightStates) ;
      if (formIsTrue) {
	if (leftChild && rightChild) {
	  its::State leftStates = getStateVerifying (leftChild) ;
	  its::State rightStates = getStateVerifying (rightChild) ;
	  its::State satB = satF * rightStates ;
	  if (satB != State::null) {
	    out << "E a U b is true because some input states immediately satisfy b. \n";
	    explain(satB,rightChild,out);
	  } else {

	    its::path_t path = model.findPath(satF,rightStates, leftStates, true);
	    out << "E a U b is true Because there are paths through states verifying a to states verifying b. \n";
	    out << "Such a minimal path of length " << path.getPath().size() << " is:\n" ;
	    model.printPath(path,out,true);
	    out << "Justification follows for subformulas.\n";
	    its::State toret = explain(path.getInit(),leftChild,out);
	    explain(path.getFinal(),rightChild,out);
	    return toret;
	  }
	} else {
	  std::cerr << "ERROR : EU has no children" << std::endl; 
	  assert(false);
	}
      } else {
	if (leftChild && rightChild) {
	  its::State leftStates = getStateVerifying (leftChild) ;
	  its::State rightStates = getStateVerifying (rightChild) ;
	  its::State satA = sat * leftStates ;
	  if (satA == State::null) {
	    out << "E a U b is false because none of your input states satisfies either a or b. \n";
	    return explain(sat,leftChild,out);
	  } else if (rightStates == its::State::null) {
	    out << "E a U b is false because no reachable states satisfy b. \n";
	    return explain(sat,rightChild,out);
	  } else {

	    its::Transition reachA = fixpoint(getNextRel()*leftStates + Transition::id,true);
	    its::State reachableA = reachA (satA);
	    its::Transition hasEG = fixpoint(getNextRel()*its::Transition::id,true);
	    its::State EGa = hasEG(reachableA);
	    out << "E a U b is false; \n";
	    if (EGa == its::State::null) {
	      out << "Although there are no cycles of the form EGa on your input states. \n";
	    } else {
	      out << "Because there exist cycles of the form EGa reachable from input states such as: \n";
	      model.printSomeStates(satA,out);
	      out << "TODO : report on lasso witness of SCC \n";
	      return satA;
	    }
	    its::State notAnotB = ( getNextRel() (reachableA) - leftStates ) - rightStates ;
	    if (notAnotB != State::null) {
	      its::path_t path = model.findPath(satA, notAnotB, reachableA, true);
	      out << "E a U b is false because all input states satisfying *a* lead to futures satisfying *not a* and *not b*. So formula : A a U !a&!b is true. \n";
	      out << "A minimal path of length " << path.getPath().size() << " from input states satisfying a to states satisfying !a and !b is:\n" ;
	      model.printPath(path,out);
	        
	    } else {
	      out << "E a U b is false because all paths satisfying a are finite (potential deadlocks !) and never traverse states satisfying b. \n";
	      return explain(satA,leftChild,out);
	    }
	  }
	} else {
	  std::cerr << "ERROR : EU has no children" << std::endl; 
	  assert(false);
	}
      }
      break;
    }
  case Ctlp_EG_c: 
    // start with states satisfying f
    // then remove states that are not a predescessor of a state in the set
    // EG f <->  ( f & pred )^* & f      
//       result = fixpoint (  
// 			   ( getPredRel()   
// 			     + ( getReachable() -  (getPredRel() (getReachable())) ) // i.e. add dead states that verify f
// 			     ) * its::Transition::id ) (leftStates) ; 
    if (formIsTrue && leftChild) {
      its::State leftStates = getStateVerifying (leftChild) ;
      
      its::Transition reachA = fixpoint(getNextRel()*leftStates + Transition::id,true);
      its::State reachableA = reachA (satF);
      // This lockstep algorithm identifies SCCs (w/o prefix or suffix) with a good overall complexity.
      // See papers on "A best symbolic SCC algorithm" by M. Vardi et. al. 
      its::Transition hasEG = fixpoint( (getNextRel()*its::Transition::id) &  (getNextRel()*its::Transition::id),true);
      its::State SCCa = hasEG(reachableA);
      
      its::path_t path = model.findPath(satF,SCCa, getReachable(), true);
      // length of path is a prefix to the lasso, a shortest path to an SCC.
      // compute SCCs really reachable from witness arrival states.
      reachableA = reachA (path.getFinal());
      SCCa = hasEG(reachableA);
      
      out << " EG a is true because following path leads from input states satisfying a to states satisfying a that belong to cycle(s) of a:\n ";
      model.printPath(path,out,true);
      out << "Some states of an SCC reachable from these final states :\n";
      model.printSomeStates(SCCa,out);
      
      return path.getInit();
    } else if (leftChild) {
      its::State leftStates = getStateVerifying (leftChild) ;
      
      its::State satA = sat * leftStates ;
      if (leftStates == its::State::null) {
	out << "EG a  is false because no reachable states satisfy a. \n";
	return explain(sat,leftChild,out);
      } else if (satA == State::null) {
	out << "EG a is false because none of your input states satisfies a. \n";
	return explain(sat,leftChild,out);
      } else {
	// either there are finite paths of a
	// or all behaviors reach !a
	its::Transition reachA = fixpoint(getNextRel()*leftStates + Transition::id,true);
	its::State reachableA = reachA (satA);
	
	its::State deadlocks =  getReachable() - getPredRel() ( getReachable());
	its::State deadA = deadlocks * reachableA;
	
	if (deadA != its::State::null) {
	  out << "EG a is false; However, there are reachable deadlocks along paths satisfying a continuously.";
	  its::path_t path = model.findPath(satA, deadA, reachableA, true);
	  model.printPath(path,out);
	  return path.getInit();
	} else {
	  out << "EGa is false, since AF!a is true. From input states satisfying a, an example shortest trace to states satisfying !a is:";
	  its::State notA = getReachable() - leftStates;
	  
	  its::path_t path = model.findPath(satA, notA, reachableA, true);
	  model.printPath(path,out);	  
	  return path.getInit();
	} 
      }
    } else {
      std::cerr << "ERROR : EG has no children" << std::endl; 
      assert(false);
    }

    break;
      
    case Ctlp_Cmp_c: 
      {
	// Forward CTL specific : compare a formula to false or true
	// i.e. check whether a set is empty or not. return State::one to indicate truth, and State::null to indicate false.
	bool invertVerdict = false;
	its::State leftStates = getStateVerifying (leftChild) ;
	if (Ctlp_FormulaReadCompareValue(ctlFormula) == 0)
	  invertVerdict =true;
	formIsTrue = (invertVerdict && leftStates == State::null) || (!invertVerdict && leftStates!=State::null);
	if (formIsTrue) {
	  out << " is true in ";
	  if (sat.nbStates()==1) {
	    out << "the single input state :\n" ;
	    model.printSomeStates(sat,out);
	  } else {
	    out << satF.nbStates() <<  " state(s) out of "<< sat.nbStates() << " input state(s).\n";
	  }
	} else {
	  out << " is false in all " << sat.nbStates() << " input state(s).\n"  ;
	}
	return explain(getReachable(),leftChild,out);
	
	break;
      }
  case Ctlp_Init_c:
      // cast to constant homomorphism
    if (formIsTrue) {
      out << "Because some input states are initial states.\n";
      return satF;
    } else {
      out << "Because none of the input states are initial states.\n";
      return sat;
    }
    break;
  case Ctlp_FwdU_c:
      /** From Vis source documentation :
       *							    t
       ** E[p U q]      = lfp Z[q V (p ^ EX(Z))]   :   p p ... p q
       ** FwdUntil(p,q) = lfp Z[p V EY(Z ^ q)]     :		    pq q q ... q
       */
      /**
       * In other words, start from states satisfying p, then add successors satisfying q to fixpoint
       * FwdUntil(p,q) =  ( q & Next  + Id)^* & p
       */
      // test for trivial reachability case
if (Ctlp_FormulaReadLeftChild(ctlFormula) &&
    Ctlp_FormulaReadType(Ctlp_FormulaReadLeftChild(ctlFormula)) ==
 	  Ctlp_Init_c &&
	   Ctlp_FormulaReadRightChild(ctlFormula) &&
 	  Ctlp_FormulaReadType(Ctlp_FormulaReadRightChild(ctlFormula)) ==
 	  Ctlp_TRUE_c ) {
// 	// cast to constant hom
// 	result = getReachable() ;
	 if (formIsTrue) {
	   out << "This subformula computes all reachable states, and there are reachable states satisfying your other criteria.\n";
	   out << "A shortest path from an initial state to a state satisfying your property is\n";
	   its::path_t path = model.findPath(getInitialState(), sat, trueF, true);
	   model.printPath(path,out,true);	  
	   return path.getFinal();
	 } else {
	   out << "This subformula computes all reachable states, and there are no reachable states satisfying your other criteria.\n";
	   out << "No counter-example trace can be provided.\n";
	   return sat;
	 }
	 break;
       }
      // the real case
      // FwdUntil(p,q) holds at any state "t", such that there exists a path through "t" from some state at which
      // p holds, and q holds at all states before "t" on the path.
       if (formIsTrue) {
	 out << "This subformula computes reachability under FwdU constraint, and there are reachable states satisfying your other criteria.\n";
	 out << "A shortest path satisfying FwdU from an input initial state to a state satisfying your property is\n";
	 its::State leftStates = getStateVerifying (leftChild) ;
	 its::path_t path = model.findPath(leftStates, sat, trueF, true);
	 model.printPath(path,out,true);
	 explain(path.getInit(),leftChild,out);	   
	 return path.getFinal();
       } else {
	 out << "This subformula computes reachable states under FwdU, and there are no such reachable states satisfying your other criteria.\n";
	 out << "No counter-example trace can be provided.\n";
	 return sat;
       }

//       result = (getNextRel() +Transition::id) (fixpoint ( (rightStates * getNextRel()) + its::Transition::id ) ( leftStates )) ;
break;
  case Ctlp_FwdG_c:
   {
	// EH (p) is the subset of states verifying "p" that are reachable through a cycle in p
        // i.e. forward SCC hull of p states (keep p suffixes).
	// EH = fixpoint ( id * getNextRel() ) (p);

	// Reachable (p,q) : states that verify "q" reachable from states verifying "p and q" 
	// (while constantly verifying "q")
	// Reach (p,q) = fixpoint (  (q * next) + id )  (p * q)

	// FwdGlobal(p,q) = EH ( Reachable (p,q) )

	// states reachable by an infinite path of f
// 	result = fixpoint (  getNextRel() 
// 			     * ( fixpoint ( (rightStates * getNextRel()) + Transition::id  ) ( leftStates * rightStates)  )
// 			     ) ( getReachable() );



	// FwdGlobal(p,q) = EH ( Reachable (p,q) )
	// Start from states p, S = p
	// Keep only those satisfying q. S = S * q
	// Add any states satisfying q, q reachable from S. S = fix( Id +  q*Next ) (S)
	// Reduce to states in cycles + suffix thereof. S = fix ( Next * Id ) (S)
     break;
   }
 case Ctlp_EY_c:
      // exists yesterday : states that have a predescessor that verifies f
      // take states verifying f, then compute successors
      // EY f  <->  Next & f (reach)
//       result = getNextRel() ( leftStates ) ;
   break;
   
  default: 
      out << "Encountered unknown type of CTL formula\n";
  }
  return sat;
}

its::State  CTLChecker::getStateVerifying (Ctlp_Formula_t *ctlFormula) const {
  its::State result;
  ctl_statecache_it it = ctl_statecache.find(ctlFormula);
  if ( it == ctl_statecache.end() ) {
    // A miss 
    // invoke recursive procedures
    its::State leftStates, rightStates;
    // Handle left child
    {
      Ctlp_Formula_t *leftChild = Ctlp_FormulaReadLeftChild(ctlFormula);
      if (leftChild) {
	leftStates = getStateVerifying (leftChild);
      }
    }
    // Handle right child
    {
      Ctlp_Formula_t *rightChild = Ctlp_FormulaReadRightChild(ctlFormula);
      if (rightChild) {
	rightStates = getStateVerifying (rightChild);
      }      
    }
    //    std::cerr << "Translating CTL formula : " ;
    //    Ctlp_FormulaPrint(vis_stderr, ctlFormula);
    //    std::cerr << std::endl;

    // Now switch on the type of formula
    switch (Ctlp_FormulaReadType(ctlFormula)) {
    case Ctlp_ID_c:
      {
	// basic case
	Transition sel =  getSelectorAP( Ctlp_FormulaReadVariableName(ctlFormula) , Ctlp_FormulaReadValueName(ctlFormula) );
	result = sel (getReachable());
	break;
      }
    case Ctlp_TRUE_c:
       // TODO : Assign to result full state space
      // result = ??

      break;

    case Ctlp_FALSE_c: 
      // TODO : Empty set of states
      // result = ??
 
      break;

    case Ctlp_NOT_c:
      // TODO : Use set difference
      // result = ??

      break;
      
    case Ctlp_AND_c:
      // TODO : use intersection 
      // result = ??
      break;

    case Ctlp_THEN_c:
      // TODO
      // A => B    <->  not A or B
      // Hence use union and set difference
      // result = ??
 
      break;

    case Ctlp_OR_c:
      // TODO
      // union of children formulae (i.e. leftStates and rightStates)
      // result = ??

      break;

    case Ctlp_EX_c:
      // TODO
       // Use predecessor relation see getPredRel and left child : leftStates
      // result = ??

      break;

    case Ctlp_EU_c: 
      {
      // TODO
       // start from states satisfying g, then add predescessors verifying f in a fixpoint.
      // f U g <-> ( f & pred + Id )^* & g
	// NB : f = leftStates, g = rightStates
      // result = ??

      break;
      }
    case Ctlp_EG_c: 
      // TODO
      // start with states satisfying f
      // then remove states that are not a predescessor of a state in the set
      // EG f <->  ( f & pred )^* & f      
      // NB : f =leftStates
      // result = ??
      break;

      /*********************************************************************************************************/

      /** The rest is specific to forward model checking */
      /*********************************************************************************************************/


    case Ctlp_EQ_c:
      assert(false);
//      result = mdd_xnor(leftMdd, rightMdd); 
      break;

    case Ctlp_XOR_c:
      assert(false);
//      result = mdd_xor(leftMdd, rightMdd); break;
      break;

			   
    case Ctlp_Cmp_c: {
      // Forward CTL specific : compare a formula to false or true
      // i.e. check whether a set is empty or not. return State::one to indicate truth, and State::null to indicate false.
      if (Ctlp_FormulaReadCompareValue(ctlFormula) == 0)
 	result = (leftStates == State::null ? State::one : State::null);
      else
	result = (leftStates == State::null ? State::null : State::one);
      break;
    }
    case Ctlp_Init_c:
      // cast to constant homomorphism
      result = getInitialState() ;
      break;
    case Ctlp_FwdU_c:
      /** From Vis source documentation :
       *							    t
       ** E[p U q]      = lfp Z[q V (p ^ EX(Z))]   :   p p ... p q
       ** FwdUntil(p,q) = lfp Z[p V EY(Z ^ q)]     :		    pq q q ... q
       */
      /**
       * In other words, start from states satisfying p, then add successors satisfying q to fixpoint
       * FwdUntil(p,q) =  ( q & Next  + Id)^* & p
       */
      // test for trivial reachability case
      if (Ctlp_FormulaReadLeftChild(ctlFormula) &&
	  Ctlp_FormulaReadType(Ctlp_FormulaReadLeftChild(ctlFormula)) ==
	  Ctlp_Init_c &&
	  Ctlp_FormulaReadRightChild(ctlFormula) &&
	  Ctlp_FormulaReadType(Ctlp_FormulaReadRightChild(ctlFormula)) ==
	  Ctlp_TRUE_c ) {
	// cast to constant hom
	result = getReachable() ;
	break;
      }
      // the real case
      // FwdUntil(p,q) holds at any state "t", such that there exists a path through "t" from some state at which
      // p holds, and q holds at all states before "t" on the path.
      
      result = (getNextRel() +Transition::id) (fixpoint ( (rightStates * getNextRel()) + its::Transition::id ) ( leftStates )) ;
      break;
    case Ctlp_FwdG_c:
      {
	// EH (p) is the subset of states verifying "p" that are reachable through a cycle in p
	// EH = fixpoint ( p * getNextRel() ) (getReachable);

	// Reachable (p,q) : states that verify "q" reachable from states verifying "p and q" 
	// (while constantly verifying "q")
	// Reach (p,q) = fixpoint (  (q * next) + id )  (p * q)

	// FwdGlobal(p,q) = EH ( Reachable (p,q) )

	// states reachable by an infinite path of f
	result = fixpoint (  getNextRel() 
			     * ( fixpoint ( (rightStates * getNextRel()) + Transition::id  ) ( leftStates * rightStates)  )
			     ) ( getReachable() );



	// FwdGlobal(p,q) = EH ( Reachable (p,q) )
	// Start from states p, S = p
	// Keep only those satisfying q. S = S * q
	// Add any states satisfying q, q reachable from S. S = fix( Id +  q*Next ) (S)
	// Reduce to states in cycles + suffix thereof. S = fix ( Next * Id ) (S)
	break;
      }
    case Ctlp_EY_c:
      // exists yesterday : states that have a predescessor that verifies f
      // take states verifying f, then compute successors
      // EY f  <->  Next & f (reach)
      result = getNextRel() ( leftStates ) ;
      break;
      
    default: 
      fail("Encountered unknown type of CTL formula\n");
    }

    // std::cerr << "Obtained Homomorphism : " << result << std::endl;
    
  } else {
    result = it->second;
  }  
  return result;
}

  its::Transition CTLChecker::getSelectorAP (Label apname, Label val) const {

  vLabel predicate = apname +  val;
  its::Transition pred = model.getPredicate(predicate);
//  std::cout << pred << std::endl;
  return pred;

// BEFORE PREDICATE API INTRODUCED WAS :
/**
  //  std::cerr << "asked for selector AP for :" << apname << std::endl;
  pType type =  model.getInstance()->getType();
  labels_t labs = type->getTransLabels();
  if ( find (labs.begin() , labs.end() , apname) == labs.end() ) {
    std::cerr << "Your atomic proposition identifier \"" << apname << "\" does not correspond to a known predicate. Check that it is the name of a place in your Petri net, or relevant with respect to your ITS type declaration." << std::endl;
    std::cerr << "Error is fatal, sorry." << std::endl;
    exit(1);
  }
  labels_t touse ;
  {
    touse.push_back(apname);
    
    Transition t = type->getSuccs (touse);
    if (! t.is_selector() ) {
      std::cerr << "Your atomic proposition identifier " << apname << " does not correspond to a state based predicate (it is not a selector). Check that it is the name of a place in your Petri net, or relevant with respect to your ITS type declaration." << std::endl;
      std::cerr << "Error is fatal, sorry." << std::endl;
      exit(1);
    }
    return t;
  }

  return Transition::id;
*/
}

its::Transition CTLChecker::getPredRel () const
{
  if (isfairtime) {
    if (predRel_ == Transition::id) {
      State reach = getReachable();
      Transition inv = getNextRel ().invert(reach);
      bool isExact = ( inv(reach) - reach == State::null );
      if (isExact) {
	predRel_ = inv;
	std::cerr << "Reverse transition relation is exact ! Faster fixpoint algorithm enabled. \n" ;
      } else {
	predRel_ = inv * reach;
	std::cerr << "Reverse transition relation is NOT exact ! Intersection with reachable at each step enabled. \n" ;
      }
    }
    return predRel_;
  } else {
    return model.getPredRel();
  }
}

its::Transition CTLChecker::getNextRel () const
{
  if (isfairtime) {
    Transition trans = model.getInstance()->getType()->getLocals();

    Transition elapse = model.getElapse(); 
    if (elapse != Transition::id) {
//      return trans + elapse;
      return  fixpoint(elapse + Transition::id) & trans;
    }
    return trans;
  } else {
    return model.getNextRel();
  }
}

its::State CTLChecker::getReachable () const {
  // this call is cached in ITSModel
  return model.computeReachable();
}

its::State CTLChecker::getInitialState () const {
  // this call is cached in ITSModel

  if (isfairtime) {
    return fixpoint(model.getElapse() + Transition::id) ( model.getInitialState() );
  } else {
    return model.getInitialState();
  }
}

its::State CTLChecker::getReachableDeadlocks () const {
  return getReachable() - (getPredRel() ( getReachable()));
}
